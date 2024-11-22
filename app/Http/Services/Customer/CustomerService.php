<?php

namespace App\Http\Services\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class CustomerService 
{
    protected $customer;
    public function __construct(Customer $customer) {
        $this->customer = $customer;
    }

    public function getListCustomer() {
        return Customer::select('id','name','username','phone', 'email', 'thumb', 'address','active')
        ->orderbyDesc('id')->paginate(10);
    }

    public function store($request) 
    {
       try 
       {
            Customer::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'active' => $request->active,
                'province_id' => $request->province_id,
                'district_id' => $request->district_id,
                'ward_id' => $request->ward_id,
                'description' => $request->description,
                'thumb' => $request->input('thumb'),
                'password' => Hash::make($request->password)
            ]);

            Session::flash('success','Customer account created successfully');
       } catch(\Exception $err) 
       {
            Session::flash('error', $err->getMessage());
            return false;
       }
       return true;
    }

    public function find($id) {
        $customer = $this->customer->find($id);
        return $customer;
    }

    public function update($request, $id) {        
        try {
            DB::beginTransaction();
    
            $customer = $this->customer->find($id);

            $updateData = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'active' => $request->active,
                'province_id' => $request->province_id,
                'district_id' => $request->district_id,
                'ward_id' => $request->ward_id,
                'description' => $request->description,
                'thumb' => $request->input('thumb'),
            ];
    
            if (!empty($request->password)) {
                $updateData['password'] = Hash::make($request->password);
            }

            $customer->update($updateData);
    
            DB::commit();
            Session::flash('success', 'Customer account updated successfully');
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
            $this->customer->find($id)->update([
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
            Session::flash('success','Customer account updated successfully');
            return true;
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error', $err->getMessage());
            return false;
        }
    }
}