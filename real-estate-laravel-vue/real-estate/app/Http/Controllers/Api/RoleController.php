<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\permissionRole;
use App\Models\role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function roles(){
      $roles = Role::select('id', 'name')->get(); 
      return response()->json([
          'message' => 'Roles Retrieved Successfully',
          'roles' => $roles,
      ]);
    }

  public function role(Request $request, $id)
  {
    $request->validate([
      'name' => 'required|string|max:255',
    ]);
    $role = Role::find($id);

    if (!$role) {
      return response()->json([
          'message' => 'Role not found',
      ], 404);
     }
     $role->name= $request->input('name');
     $role->save();
    return response()->json([
          'message' => 'Roles Retrieved Successfully',
          'roles' => $role,
      ]);
  }

  public function rolePermissions(Request $request,$roleId){
    $role = Role::find($roleId);
    $permissions = Permission::select('id', 'name')->get();

    $assignedPermissions = PermissionRole::where('role_id', $roleId)->pluck('permission_id')->toArray();
    $permissionsList = $permissions->map(function ($permission) use ($assignedPermissions) {
        return [
            'id' => $permission->id,
            'name' => $permission->name,
            'assigned' => in_array($permission->id, $assignedPermissions),
        ];
    });
    return response()->json([
        'message' => 'Permissions Retrieved Successfully',
        'roleName' => $role->name,
        'permissions' => $permissionsList,
    ]);
  }

  public function permissions(){
    $permissions=Permission::select('id','name')->get();
    return response()->json([
      'message'=>'Permission Retrieved Successfully',
      'permissions'=>$permissions,
    ]);
  }
  public function update(request $request){
    $roleId=$request->role_id;
    $permissions = $request->permissions;
    foreach ($permissions as $permission) {
      $permissionId = $permission['id'];
      $isChecked = $permission['checked'];

      $existingPermission = permissionRole::where('role_id', $roleId)
      ->where('permission_id', $permissionId)
      ->first();

      if ($isChecked) {
        if (!$existingPermission) {
            permissionRole::create([
                'role_id' => $roleId,
                'permission_id' => $permissionId,
            ]);
        }
    } else {
        if ($existingPermission) {
            $existingPermission->delete();
        }
    }
  }

  return response()->json(['message' => 'Permissions updated successfully.']);
  }
}
