<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleAddRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminRolesController extends Controller
{
    private $role;
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function index(){
        $roles = $this->role->paginate(5);
        return view('admin.role.index', compact('roles'));

    }
    public function create(){
        return view('admin.role.add');
    }

    public function store(RoleAddRequest $request){
        dd('route store...');
    }
}
