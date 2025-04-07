<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
   
  public function Form_register(){
    return view('Register');
  }

  public function Store_register(Request $request){
  
   User::create([
    'name'=>$request['name'],
    
    'email'=>$request['email'],
    'password'=>Hash::make($request['password']),
   ]);
    return view('Register');
  }

public function Login_data(Request $request){
    $validated = $request->validate([
     'email'=>'required|email',
     'password'=>'required',
    ]);
    if(Auth::attempt($validated)){
     return redirect()->route('dashboard');
    }
    return redirect()->back()->with('error','Please Check Your Email & Password');
 }
 //logout function
 public function Logout(Request $request){
     Auth::logout();
         
         $request->session()->invalidate();
         $request->session()->regenerateToken();
         
         return redirect('/');
 }
}
