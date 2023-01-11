<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function show(){
        $cartItem=0;
        $cartItem = Cart::count('id');
        return view('about',compact('cartItem'));
    }
}
