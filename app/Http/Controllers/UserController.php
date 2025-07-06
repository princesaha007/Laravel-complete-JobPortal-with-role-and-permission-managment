<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view users')->only('index');
        $this->middleware('permission:edit users')->only('edit', 'update');
        $this->middleware('permission:create users')->only('create', 'store');
        $this->middleware('permission:delete users')->only('destroy');

    }

    

    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.list' , ['users' => $users]);
    }


    public function create()
    {
        $roles= Role::orderBy('name' , 'asc')->get();
        return view('users.create', [
            'roles'=>$roles
        ]);

    }

 

    public function store(Request $request)
    {
        
         $validated = $request-> validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|same:confirm_password',
            'confirm_password' => 'required'

        ]);

        if ($validated){

            $user= new User();
            $user->name = $request->name;
            $user->email = $request -> email;
            $user->password = Hash::make($request -> password);

            $user->save();

            $user->  syncRoles($request-> role);

            return redirect()->route('users.index')->with('success', 'user added successfully');

        }else{

            return redirect()->route('users.create' , $id)->withInput()->withErrors($validated);


        }

    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles= Role::orderBy('name' , 'asc')->get();

        $hasRoles = $user->roles->pluck('name');
        return view('users.edit' , [
            'ourUser' => $user,
            'roles' => $roles,
            'hasRole'=> $hasRoles
        
        ]);
    }


    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
         $validated = $request-> validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id

        ]);

        if ($validated){
            $user->name = $request->name;
            $user->email = $request -> email;
            $user->save();

            $user->  syncRoles($request-> role);

            return redirect()->route('users.index')->with('success', 'user updated successfully');

        }else{

            return redirect()->route('users.edit' , $id)->withInput()->withErrors($validated);


        }






    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user= User::findOrFail($id);
        $user-> delete();
        return redirect()->route('users.index')->with('success', 'users deleted successfully');
    }
}
