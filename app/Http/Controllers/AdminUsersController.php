<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Traits\DeleteModelTrait;

class AdminUsersController extends Controller
{
    use DeleteModelTrait;
    private $user;
    private $role;
    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index(){
        $users = $this->user->paginate(5);
        return view('admin.user.index', compact('users'));
    }
    public function create(){
        $roles = $this->role->all();
        return view('admin.user.add', compact('roles'));
    }

    public function store(UserAddRequest $request){
        try {
            // This transaction below doesn't work: can't file the solution: I will find it later;
            DB::beginTransaction();
            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            // use robust eloquent
            $user->roles()->attach($request->role_id);
            DB::commit();
            return redirect()->route('users.index');

        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
        }
    }
    public function edit($id){
        $roles = $this->role->all();
        $user = $this->user->find($id);
        $rolesOfUser = $user->roles;
        return view('admin.user.edit', compact('roles', 'user', 'rolesOfUser'));
    }

    public function update(UserAddRequest $request, $id){
        try {
            // This transaction below doesn't work: can't file the solution: I will find it later;
            DB::beginTransaction();
            $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            // use robust eloquent : sync delete the old things, and add the new thing to table role_user;
            $user = $this->user->find($id);
            $user->roles()->sync($request->role_id);
            DB::commit();
            return redirect()->route('users.index');

        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
        }
    }

    public function delete($id){
        return $this->deleteModelTrait($id, $this->user);
    }
}
