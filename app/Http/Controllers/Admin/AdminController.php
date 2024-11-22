<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CreateFormRequest;
use App\Http\Requests\Admin\EditFormRequest;
use App\Http\Requests\Admin\ProfileFormRequest;
use App\Models\Admin;
use App\Models\Role;
use App\Http\Services\Admin\AdminService;

use App\Models\Province;
use App\Models\District;
use App\Models\Ward;


class AdminController extends Controller
{

    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function getDistricts($provinceId)
    {
        $provinceId = intval($provinceId);
        $districts = District::where('province_id', $provinceId)->pluck('full_name', 'id');
        return response()->json($districts);
    }

    public function getWards($districtId)
    {
        $districtId = intval($districtId);
        $wards = Ward::where('district_id', $districtId)->pluck('full_name', 'id');
        return response()->json($wards);
    }

    public function index() {

        return view('admin.admins.list',[
            'title' => 'List of employees ',
            'roles' => $this->adminService->getListRole(),
            'admins' => $this->adminService->getListAdmin()
        ]);
    }


    public function create() {
        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();

        return view('admin.admins.add',[
            'title' => 'Add employee ',
            'roles' => $this->adminService->getListRole(),
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards
        ]);
    }

    public function store(CreateFormRequest $request) {

        $result=$this->adminService->create($request);
        if($result){
            return redirect()->route('admins.index');
        }
        return redirect()->back();     
    }

    public function edit($id) {

        $roles = $this->adminService->getListRole();
        $admin = $this->adminService->find($id);
        $title = 'Edit employee ' .$admin->name;

        $admin->province_id = (int) $admin->province_id;
        $admin->district_id = (int) $admin->district_id;

        $provinces = Province::select('id', 'name', 'full_name')->get();
        $districts = District::where('province_id', $admin->province_id)->get();
        $wards = Ward::where('district_id', $admin->district_id)->get();

        return view('admin.admins.edit',compact(        
            'roles', 'admin', 'title', 'provinces', 'districts', 'wards'
        ));
    }

    public function update(EditFormRequest $request, $id) {        
        $result=$this->adminService->update($request, $id);
        if($result){
            return redirect()->route('admins.index');
        }
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $admin = Admin::find($request->input('id'));

        if ($admin) {
            $admin->delete();
            return response()->json([
                'error' => false,
                'message' => 'User deleted successfully'
            ]);
        } else {
            return response()->json([
                'error' => true
            ]);
        }
    }
    
    public function profile($id)
    {
        $admin = Admin::find($id);
        $title = 'Profile ' .$admin->name;

        $admin->province_id = (int) $admin->province_id;
        $admin->district_id = (int) $admin->district_id;

        $provinces = Province::select('id', 'name', 'full_name')->get();
        $districts = District::where('province_id', $admin->province_id)->get();
        $wards = Ward::where('district_id', $admin->district_id)->get();

        return view('admin.admins.profile',compact(        
            'admin', 'title', 'provinces', 'districts', 'wards'
        ));
    }

    public function editprofile(ProfileFormRequest $request, $id) {        
        $result=$this->adminService->editprofile($request, $id);
        if($result){
            return redirect()->route('admins.profile',['id' =>$id]);
        }
        return redirect()->back();
    }


    public function search(Request $request)
    {
        $query = Admin::query();

        if ($request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->username) {
            $query->where('username', 'like', '%' . $request->username . '%');
        }
        if ($request->phone) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }
        if ($request->email) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->role_id) {
            $query->where('role_id', $request->role_id);
        }

        $admins = $query->get();

        $roles = $this->adminService->getListRole();

        return view('admin.admins.admin_table', compact(
            'admins', 'roles'
        ))->render();
    }

    
}
