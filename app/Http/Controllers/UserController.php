<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Builder;
use App\Models\User;
use App\Models\Client;
// use Spatie\Permission\Models\Role;
use App\Models\Role;
use Auth, DB, Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{

    public function index(Request $request)
    {

        // $users = \App\User::with('roles')->get();
        // $nonmembers = $users->reject(function ($user, $key) {
        //     return $user->hasRole('Member');
        // });
        $role = config('global.exclude_roles');
        $users = User::with('roles')
		->whereHas('roles', function ($query) use($role) {
			// $query->whereNotIn('name', '!=',$role);
			$query->whereNotIn('name', $role);
		})
        ->orderBy('created_at', 'DESC')->paginate(10);

        // $data = User::with('roles')->orderBy('id', 'DESC')->paginate(10);
        return view('users.index', compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $roles = Role::whereNotIn('name',config('global.exclude_roles'))->pluck('name', 'name')->all();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(UserStoreRequest $request)
    {
        $input = $request->all();

        $input['password'] = Hash::make($input['password']);
        $input['user_role'] = $input['roles'][0];

        $user = User::create($input);

        if(is_array($request->input('roles')) && in_array('Client',$request->input('roles'),true))
        {
            $image_path = null;
            // $image_dir = '/clients/logo';
            // $image_user_dir = '/clients/logo/'.$user->id;
            // if($request->hasFile('logo')){
            //     $image = $request->file('logo');
            //     $image_name = $image->getClientOriginalName();
            //     $image->move(public_path($image_dir),$image_name);

            //     $image_path = $image_dir."/" . $image_name;
            // }
            // $request->file('logo')->move(public_path() . $image_user_dir.'.jpg');

            $result =   Client::create([
                'user_id'    => $user->id,
                'client_id'  => generateUniqueCodeNumber(Client::class),
                'company_name'    => $request->company_name,
                'office_address'    => $request->office_address,
                'logo'    => $image_path,
            ]);
        }

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findorFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findorFail($id);
        $roles = Role::whereNotIn('name',config('global.exclude_roles'))->pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email, '.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        }else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::findorFail($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findorFail($id)->delete();
        return redirect()->route('users.index')
                        ->with('success', 'User deleted successfully');
    }

    public function viewClient(Request $request)
    {
    	$viewRender = view('clients.client_fields')->render();
	    return response()->json(array('success' => true, 'html'=>$viewRender));
    }

    public function viewProfile(Request $request)
    {
        $data = User::findorFail(Auth::user()->id);
        return view('profile.show', compact('data'));
    }

    public function editProfile($id)
    {
        $editProfile = User::where('id', $id)->first();

        return view('profile.pages-profile', compact('editProfile'));
    }

    public function updateProfile(Request $request, $id)
    {
        $profile = User::findorFail(Auth::user()->id);
        $request->validate(
            [
                'contact' => 'required',
            ],
        );

        $profile->contact = $request->contact;

        if($profile->save()) {
            return response()->json([
                "success" => true,
                "data" => [],
                "message" => "Contact number change successfully."
            ], 200);
        }

        return response()->json([
            "success" => false,
            "data" => [],
            "message" => $response_profile['message']
        ], 404);
    }
    public function changePassword(Request $request)
    {
        $request->validate(
            [
                'current_password' => 'required',
            ],
            [
                'new_password' => 'required',
            ],
            [
                'confirm_password' => 'required',
            ],
        );

        $user = User::findorFail(Auth::user()->id);
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                "success" => false,
                "data" => [],
                "message" => "Current password is not correct."
            ], 404);
        }
        if ($user->update(['password' => Hash::make($request->new_password)])) {
            return response()->json([
                "success" => true,
                "data" => [],
                "message" => "Password change successfully."
            ], 200);
        }
        return response()->json([
            "success" => false,
            "data" => [],
            "message" => "Oops! something went wrong try again."
        ], 404);
    }
}
