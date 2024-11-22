<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\ProfileFormRequest;
use App\Models\Customer;
use App\Http\Services\Customer\CustomerService;

use App\Models\Province;
use App\Models\District;
use App\Models\Ward;


class CustomerController extends Controller
{

    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
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

    
    public function profile($id)
    {
        $customer = $this->customerService->find($id);

        $customer->province_id = (int) $customer->province_id;
        $customer->district_id = (int) $customer->district_id;

        $title = 'Edit profile ' .$customer->name;

        $provinces = Province::select('id', 'name', 'full_name')->get();
        $districts = District::where('province_id', $customer->province_id)->get();
        $wards = Ward::where('district_id', $customer->district_id)->get();

        return view('customer.customers.profile',compact(        
            'customer', 'title', 'provinces', 'districts', 'wards'
        ));
    } 

    public function editprofile(ProfileFormRequest $request, $id) {        
        $result=$this->customerService->editprofile($request, $id);
        if($result){
            return redirect()->route('customer.profile',['id' =>$id]);
        }
        return redirect()->back();
    }

    
}
