<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Requests\Customer\CreateFormRequest;
use App\Http\Requests\Customer\EditFormRequest;
use App\Http\Services\Customer\CustomerService;


class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index() {

        return view('admin.customers.list',[
            'title' => 'List of customers ',
            'customers' => $this->customerService->getListCustomer()
        ]);
    }
    
    public function create() {

        return view('admin.customers.add',[
            'title' => 'Create customer '
        ]);
    }

    public function store(CreateFormRequest $request) {
        $result=$this->customerService->store($request);
        if($result){
            return redirect()->route('customers.index');
        }
        return redirect()->back();   
    }

    public function edit($id) {
        
        $customer = $this->customerService->find($id);
        $title = 'Edit customer ' .$customer->name;

        return view('admin.customers.edit',compact(        
            'customer', 'title'
        ));
    }

    public function update(EditFormRequest $request, $id) {        
        $result=$this->customerService->update($request, $id);
        if($result){
            return redirect()->route('customers.index');
        }
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $customer = Customer::find($request->input('id'));

        if ($customer) {
            $customer->delete();
            return response()->json([
                'error' => false,
                'message' => 'Customer deleted successfully'
            ]);
        } else {
            return response()->json([
                'error' => true
            ]);
        }
    }

    public function search(Request $request)
    {
        $query = Customer::query();

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

        $customers = $query->get();

        return view('admin.customers.customer_table', compact('customers'))->render();
    }
}
