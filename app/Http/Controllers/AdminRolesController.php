<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleAddRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;

class AdminRolesController extends Controller
{
    use DeleteModelTrait;
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission =$permission;
    }

    public function index(){
        $roles = $this->role->paginate(5);
        return view('admin.role.index', compact('roles'));

    }
    public function create(){
        $permissionsParents = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.add', compact('permissionsParents'));
    }

    public function store(RoleAddRequest $request){
        $role = $this->role->create([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);
        $role->permissions()->attach($request->permission_id);
        return redirect()->route('roles.index');
    }

    public function edit($id){
        $permissionsParents = $this->permission->where('parent_id', 0)->get();
        $role = $this->role->find($id);
        $permissionChecked = $role->permissions;
        return view('admin.role.edit', compact('permissionsParents', 'role', 'permissionChecked'));
    }
    //ok
    public function update(RoleAddRequest $request, $id){
        $this->role->find($id)->update([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);
        $role = $this->role->find($id);
        $role->permissions()->sync($request->permission_id);
        return redirect()->route('roles.index');
    }
    public function delete($id){
        return $this->deleteModelTrait($id, $this->role);
    }
}
