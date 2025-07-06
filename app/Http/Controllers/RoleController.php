<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



class RoleController extends Controller 

{


    public function __construct()
    {
        $this->middleware('permission:view roles')->only('index');
        $this->middleware('permission:edit roles')->only('edit', 'update');
        $this->middleware('permission:create roles')->only('create', 'store');
        $this->middleware('permission:delete roles')->only('destroy');
    }


    public function index()
    {
        // This method will show the list of roles
        $roles = Role::orderBy('id', 'desc')->paginate(10);
        return view('roles.list', compact('roles'));
        
    }
    



     // This method will show the create role page
    public function create()
    {
          $permissions = Permission::orderBy('id', 'desc')->get();
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



    // edit
    public function edit($id){
        $role= Role::findOrFail($id);
        $hasPermissions= $role->permissions->pluck('name');

        $permissions = Permission::orderBy('id', 'desc')->get();

        return view('roles.edit' , [
            'permissions' => $permissions,
            'ourHasPermissions' => $hasPermissions,
            'role' => $role
        ]);
    }


    // update
    public function update($id, Request $request)
    {
        $role = Role::findOrFail($id);
    
        // Validate input
        $validated = $request->validate([
            'name' => ['required', Rule::unique('roles')->ignore($id)],
        ]);
    
        // Update the existing role's name
        $role->name = $request->name;
        $role->save();
    
        // Sync permissions (remove old, assign new)
        $role->syncPermissions($request->permissions ?? []);
    
        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
        
    }
    

    //delete
    public function destroy($id){
        $role= Role::findOrFail($id);
        $role-> delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }



}
