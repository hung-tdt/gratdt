<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class LoginController extends Controller
{
    public function login (){
        return view('customer.customers.login', [
            'title' => 'Đăng nhập'
        ]);
    }

    public function loginStore(Request $request)
    {
        
        $this->validate($request,[
            'email' =>'required|email:filter',
            'password' => 'required'
        ],[
            'email.required'=>'You have not entered an email',
            'password.required'=>'You have not entered a password'
        ]);

        $credentials = [
            'email'=>$request->input(key:'email'),
            'password'=>$request->input(key:'password'), 
        ];
        $customer = Customer::where('email', $credentials['email'])->first();

        if ($customer && $customer->active == 1) {
            if (Auth::guard('customer')->attempt($credentials)) {
                return redirect()->route('home');           
            }
            Session::flash('error', 'Incorrect email or password.');
            return redirect()->back();
        }
        Session::flash('error', 'Account is inactive or does not exist.');
        return redirect()->back();
    }

    public function register(Request $request)
    {
        return view('customer.customers.register', [
            'title' => 'Đăng kí'
        ]);
    }

    public function registerStore(Request $request)
    {
    $validated = $request->validate([
        'name' => 'required',
        'active' => 'required',
        'username' => 'required|string|max:255|unique:customers,username',
        'phone' => 'required',
        'email' => 'required|string|email|max:255|unique:customers,email',
        'password' => 'required|string|min:8|confirmed',
    ],[
        'name.required' => 'You have not entered a name',
        'username.required' => 'You have not entered a username',
        'phone.required' => 'You have not entered a phone',
        'username.unique' => 'The username is already taken',
        'email.required' => 'You have not entered an email',
        'email.email' => 'The email must be a valid email address',
        'email.unique' => 'The email is already registered',
        'password.required' => 'You have not entered a password',
        'password.min' => 'The password must be at least 8 characters',
        'password.confirmed' => 'Password confirmation does not match',
    ]);

    $customer = Customer::create([
        'name' => $validated['name'],
        'active' => $validated['active'],
        'username' => $validated['username'],
        'phone' => $validated['phone'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']), 
    ]);

    auth('customer')->login($customer);
    return redirect()->route('home');
    }

    public function logout(Request $request) {

        Auth::guard('customer')->logout();

        $request->session()->invalidate(); 
        $request->session()->regenerateToken();
        return redirect()->route('customer.login');
    }
}
