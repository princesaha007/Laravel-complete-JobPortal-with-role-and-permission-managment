<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        // This method will show the list of roles
        return view('roles.list', [
            'roles' => Role::orderBy('id', 'desc')->paginate(10)
        ]);
        
    }

     // This method will show the create role page
    public function create()
    {
          $permissions = Permission::orderBy('id', 'desc')->paginate(10);
       return view('roles.create' , compact('permissions'));
    }


     // This method will store a new role in the database
    public function store(Request $request){
      
      
       $validated = $request-> validate([
            'name' => 'required|unique:roles|min:3'
        ]);

        if ($validated) {
            // Create the role
                $role = new Role();
                $role->name= $request->name;
                $role->save();

                if(!empty($request->permissions)){
                    foreach($request->permissions as $name){
                        $role->givePermissionTo($name);
                    }
                }



            return redirect()->route('roles.index')->with('success', 'role added successfully');

        }else{
            return redirect()-> route('roles.create')->withInput()->withErrors($validated);
        }
 
    }
}
