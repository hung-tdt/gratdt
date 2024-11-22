<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class RoleController extends Controller
{
    protected $permission;
    protected $role;
    public function __construct(Permission $permission,Role $role) {
        $this->permission = $permission;
        $this->role = $role;
    }


    public function index() {
        $roles = $this->role->paginate(10);
        return view('admin.roles.index',[
            'title' => 'List of permission groups ',
            'roles' => $roles,
        ]);
    }

    public function create() {
        $permissionsParent = $this->permission->where('parent_id', 0)->get();
        return view('admin.roles.add',[
            'title' => 'Add new role ',
            'permissionsParent' => $permissionsParent,
        ]);
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();
            $role = $this->role->create([
                'name' => $request->name,
                'description' => $request->description
            ]);
            $role->permissions()->attach($request->permission_id);    
            DB::commit();
            Session::flash('success','Permission group creation successful');
            return redirect()->route('roles.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('error', $exception->getMessage());
            Log::error('Message :' . $exception->getMessage() . '--- Line : ' . $exception->getLine());
        }
        
    }

    public function edit($id) {
        
        $permissionsParent = $this->permission->where('parent_id', 0)->get();
        $role = $this->role->find($id);
        $title = 'Edit role ' .$role->name;
        $permissionChecked = $role->permissions;

        return view('admin.roles.edit',compact(        
            'permissionsParent', 'role', 'title', 'permissionChecked'
        ));
    }

    public function update(Request $request, $id) {        
        try {
            DB::beginTransaction();
            $role = $this->role->find($id);
            $role->update([
                'name' => $request->name,
                'description' => $request->description
            ]);
            $role->permissions()->sync($request->permission_id);    
            DB::commit();
            Session::flash('success','Group permission update successful');
            return redirect()->route('roles.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('error', $exception->getMessage());
            Log::error('Message :' . $exception->getMessage() . '--- Line : ' . $exception->getLine());
        }
    }

    public function destroy(Request $request)
    {
        $role = Role::find($request->input('id'));

        if ($role) {
            $role->delete();
            return response()->json([
                'error' => false,
                'message' => 'Delete permission group successfully'
            ]);
            
        } else {
            return response()->json([
                'error' => true
            ]);
        }
    }
}   