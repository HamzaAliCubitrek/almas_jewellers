<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\RoleStoreRequest as Create;
use DB,Auth,Str;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-list|
         role-create|role-edit|role-delete',
         ['only' => ['index', 'store']]
        );
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $roles = Role::orderBy('created_at', 'DESC')->paginate(10);
        return view('roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(Request $request)
    {
        $permissionLabel = array();
        $id = Auth::user()->roles[0]->id;
        $role = Role::findorFail($id);

        $permission = Permission::whereNull('deleted_at')->get();

        $rolePermissions = DB::table('role_has_permissions')
                    ->where([
                        'role_has_permissions.role_id' => $id,
                    ])
                    ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                    ->all();

        $makeCheckAll = 0;

        if (!empty($permission) && !empty($rolePermissions)) {
            $makeCheckAll = count($permission) == count($rolePermissions) ? 1 : 0;
        }

        $system_role_permission_for = config('global.system_role_permission_for');

        //permissions group by
        foreach($permission as $value) {
            $tempValue = $value->name;
            $tempValue = str_replace("-public","",$tempValue);
            $tempValue = str_replace("-list","",$tempValue);
            $tempValue = str_replace("-index","",$tempValue);
            $tempValue = str_replace("-create","",$tempValue);
            $tempValue = str_replace("-store","",$tempValue);
            $tempValue = str_replace("-edit","",$tempValue);
            $tempValue = str_replace("-update","",$tempValue);
            $tempValue = str_replace("-destroy","",$tempValue);
            $tempValue = str_replace("-delete","",$tempValue);
            $tempValue = str_replace("-show","",$tempValue);
            array_push($permissionLabel, $tempValue);
        }
        $permissionLabel = array_unique($permissionLabel);
        return view('roles.create', compact('role', 'permission', 'rolePermissions', 'makeCheckAll', 'system_role_permission_for',
        'permissionLabel'));
    }

    public function store(Create $request)
    {
        $id = Str::uuid()->toString();
        $role;
        if($request->id != "") {
            $role = Role::findorFail($request->id);
            // $id = $role->id;
            $role->updated_by = Auth::user()->id;
        }
        else {
            $role = new Role;
            // $role->id = $id;
            $role->created_by = Auth::user()->id;
        }

        $role->name = $request->input('name');
        $role->guard_name = 'web';
        $role->status = 1;

        if($role->save()) {
            $permissions = Permission::whereIn('id', $request->permission)->get();
            $role->syncPermissions($permissions);

            return response()->json([
                "success" => true,
                "data" => ["id" => $role->id],
                "message" => "Role saved."
            ], 200);
        }

        return response()->json([
            "success" => false,
            "data" => [],
            "message" => "Opps! something went wrong try again."
        ], 404);
    }

    public function show($id)
    {
        $role = Role::findorFail($id);
        $rolePermissions = Permission::
        join("role_has_permissions",
        "role_has_permissions.permission_id", "=", "permissions.id"
        )
        ->where("role_has_permissions.role_id", $id)
        ->get();

        return view('roles.show', compact('role', 'rolePermissions'));
    }

    public function edit($id)
    {
        $permissionLabel = array();

        $data = Role::findorFail($id);

        $permission = Permission::whereNull('deleted_at')
                    ->get();

        $rolePermissions = DB::table('role_has_permissions')
                    ->where([
                        'role_has_permissions.role_id' => $id,
                    ])
                    ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                    ->all();

        $makeCheckAll = 0;

        if (!empty($permission) && !empty($rolePermissions)) {
            $makeCheckAll = count($permission) == count($rolePermissions) ? 1 : 0;
        }

        $system_role_permission_for = config('global.system_role_permission_for');

        //permissions group by
        foreach($permission as $value) {
            $tempValue = $value->name;
            $tempValue = str_replace("-public","",$tempValue);
            $tempValue = str_replace("-list","",$tempValue);
            $tempValue = str_replace("-index","",$tempValue);
            $tempValue = str_replace("-create","",$tempValue);
            $tempValue = str_replace("-store","",$tempValue);
            $tempValue = str_replace("-edit","",$tempValue);
            $tempValue = str_replace("-update","",$tempValue);
            $tempValue = str_replace("-destory","",$tempValue);
            $tempValue = str_replace("-delete","",$tempValue);
            $tempValue = str_replace("-show","",$tempValue);
            array_push($permissionLabel, $tempValue);
        }
        $permissionLabel = array_unique($permissionLabel);

        return view('roles.create', compact('data', 'permission', 'rolePermissions', 'makeCheckAll', 'system_role_permission_for',
        'permissionLabel'));
    }

    public function destroy($id)
    {
        $data = Role::findorFail($id);

        if ($data->delete()) {
            return response()->json([
                    'success' => true,
                    'message' => "Deleted Successfully",
            ], 200,);
        }

        return response()->json([
            "success" => false,
            "data" => [],
            "message" => "Opps! something went wrong try again."
        ], 404);
    }
}
