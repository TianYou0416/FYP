<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;


class userController extends Controller
{
    public function show(){
        $cartItem=0;
        $cartItem = Cart::count('id');
        return view('userRegister',compact('cartItem')); //directly go to register page
    }

    public function store(Request $request){
        $cartItem=0;
        $cartItem = Cart::count('id');
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password =bcrypt($request->password);
        $customer->confirm_password = bcrypt($request->confirm_password);
        $customer->save();
  
        $customer_id = $customer->customer_id;
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$customer->name);
        return redirect('/',compact('cartItem'));
        
        // return view('userLogin');
    }

    public function login(){
        $cartItem=0;
        $cartItem = Cart::count('id');
        return view('userLogin',compact('cartItem'));
    }

    public function check(Request $request){
        $cartItem=0;
        $cartItem = Cart::count('id');
        $customer = Customer::where('email',$request->email)->first();
        if(password_verify($request->password, $customer->password)){
             Session::put('customer_id',$customer->customer_id);
             Session::put('customer_name',$customer->name);

             return view('welcome',compact('cartItem'));
        } 
        else 
        {
             return redirect('userLogin')->with('sms', 'Your password is incorrect, Please provide us your correct password');
        }
    }

    public function logout(){
        Session::forget('customer_id');
        Session::forget('customer_name');
        return redirect('/');
     }

}

