<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate(5);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return to_route('users.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
             'email' => 'required|email|unique:users,email,'.$id,
             'password' => 'same:confirm-password',
             'roles' => 'required'
         ]);

         $input = $request->all();

         if(!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
         } else {
            $input = Arr::except($input, array('password'));
         }

         $user = User::find($id);
         $user->update($input);
         $user->save();

         DB::table('model_has_roles')->where('model_id', $id)->delete();

         $user->assignRole($request->input('roles'));

         return to_route('users.index');
    }


    public function destroy($id)
    {
        User::find($id)->delete();

        return to_route('users.index');
    }
}
