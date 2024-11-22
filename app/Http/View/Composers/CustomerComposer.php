<?php
 
namespace App\Http\View\Composers;

use App\Models\Customer;
use Illuminate\View\View;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
 
class CustomerComposer
{
    
    public function __construct() 
    {

    }
     
    public function compose(View $view): void
    {
        $id = Auth::guard('customer')->id();
        $customer = Customer::find($id);
        $view->with('customer', $customer);
    }
}