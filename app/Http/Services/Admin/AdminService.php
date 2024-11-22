<?php

namespace App\Http\Services\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class AdminService 
{
    protected $admin;
    protected $role;
    public function __construct(Admin $admin,Role $role) {
        $this->admin = $admin;
        $this->role = $role;
    }

    public function getListAdmin() {
        return Admin::orderbyDesc('id')->paginate(10);
    }


    public function getListRole() {
        return Role::select('id', 'name')->get();
    }

    public function create($request) 
    {
       try 
       {
            $provinceId = str_pad((string) $request->province_id, 2, '0', STR_PAD_LEFT);
            $districtId = str_pad((string) $request->district_id, 3, '0', STR_PAD_LEFT);
            $wardId = str_pad((string) $request->ward_id, 5, '0', STR_PAD_LEFT);
            Admin::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'status' => $request->status,
                'thumb' => $request->input('thumb'),
                'role_id' => $request->role_id,
                'province_id' => $provinceId, 
                'district_id' => $districtId, 
                'ward_id' => $wardId, 
                'password' => Hash::make($request->password)
            ]);

            Session::flash('success','Account created successfully');
       } catch(\Exception $err) 
       {
            Session::flash('error', $err->getMessage());
            return false;
       }
       return true;
    }

    public function find($id) {
        $admin = $this->admin->find($id);
        return $admin;
    }

    public function update($request, $id) {        
        try {
            $provinceId = str_pad((string) $request->province_id, 2, '0', STR_PAD_LEFT);
            $districtId = str_pad((string) $request->district_id, 3, '0', STR_PAD_LEFT);
            $wardId = str_pad((string) $request->ward_id, 5, '0', STR_PAD_LEFT);
    
            DB::beginTransaction();
    
            $admin = $this->admin->find($id);
            
            $updateData = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'status' => $request->status,
                'thumb' => $request->input('thumb'),
                'role_id' => $request->role_id,
                'province_id' => $provinceId, 
                'district_id' => $districtId, 
                'ward_id' => $wardId,
            ];
    
            // Check if a new password is provided
            if (!empty($request->password)) {
                $updateData['password'] = Hash::make($request->password);
            }
    
            $admin->update($updateData);
    
            DB::commit();
            Session::flash('success', 'Account update successful');
            return true;
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

    public function editprofile($request, $id) {        
        try {
            $provinceId = str_pad((string) $request->province_id, 2, '0', STR_PAD_LEFT);
            $districtId = str_pad((string) $request->district_id, 3, '0', STR_PAD_LEFT);
            $wardId = str_pad((string) $request->ward_id, 5, '0', STR_PAD_LEFT);
            DB::beginTransaction();
            $this->admin->find($id)->update([
                'name' => $request->name,               
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'province_id' => $provinceId, 
                'district_id' => $districtId, 
                'ward_id' => $wardId, 
                'thumb' => $request->input('thumb')
            ]);          
            DB::commit();
            Session::flash('success','Account update successful');
            return true;
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error', $err->getMessage());
            return false;
        }
    }
}