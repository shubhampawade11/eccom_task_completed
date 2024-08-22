<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function HomePage(){
        return view('user.user-home');
    }

    public function HomePageAdmin(){
        $users = Auth::guard('admin')->user(); 
       
        $products = Product::paginate(5); 
       
        return view('admin.admin-home', compact('products', 'users'));
    }

    public function HomePageUser(){
        $users = Auth::guard('web')->user(); 
       
        $products = Product::paginate(5); 
       
        return view('user.user-home', compact('products', 'users'));
    }


}
