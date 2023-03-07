<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\PermissionStoreRequest;
use DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        // $this->middleware('permission:permission-list|
        //  permission-create|permission-edit|permission-delete',
        //  ['only' => ['index', 'store']]
        // );
        // $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = Permission::withTrashed()->orderBy('created_at', 'DESC')->paginate(10);
        return view('permissions.index', compact('permissions'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('permissions.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionStoreRequest $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);

        $permission = Permission::create(['name' => $request->input('name')]);

        return redirect()->route('permissions.index')
                        ->with('success', 'Permission created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::findorFail($id);
        return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findorFail($id);
        // $permission = Permission::get();
        // $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
        //     ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
        //     ->all();

        return view('permissions.edit', compact('permission'));
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
            'name' => 'required'
        ]);

        $permission = Permission::findorFail($id);
        $permission->name = $request->input('name');
        $permission->save();

        // $permission->syncPermissions($request->input('permission'));

        return redirect()->route('permissions.index')
                        ->with('success', 'Permission updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::table("permissions")->where('id', $id)->delete();
        return redirect()->route('permissions.index')
                        ->with('success', 'Permission deleted successfully');
    }
    public function restore(Permission $permission)
    {
        dd($permission);
        $permission->restore();
        return redirect()->route('permissions.index')
                        ->with('success', 'Permission deleted successfully');
    }
}
