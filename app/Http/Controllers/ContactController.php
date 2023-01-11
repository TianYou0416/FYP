<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Gloudemans\Shoppingcart\Facades\Cart;

class ContactController extends Controller
{
    public function show(){
        $cartItem=0;
        $cartItem = Cart::count('id');
        return view('contact',compact('cartItem'));
    }
    public function add(){

        $r=request();
        $addContact=Contact::create([
            'fName' => $r -> fName,
            'lName' => $r -> lName,
            'email' => $r -> email,
            'message' => $r -> message,
        ]);
        $cartItem=0;
        $cartItem = Cart::count('id');
        return view('contact', compact('cartItem'));
        }
}