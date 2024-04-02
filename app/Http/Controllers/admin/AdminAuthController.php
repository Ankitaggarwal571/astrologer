<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    //
    public function login(){
        return view('admin.adminLogin');
    }

    public function logged(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        $data = array(
            'email' => $request->email,
            'password' => $request->password
        ); 
        if (Auth::attempt($data)) {
            return redirect()->route("dashboard")->with('success','Login Successfull');
        }else{
            return back()->withErrors(['error'=>'Invalid email or password'])->withInput($request->only('email'));
        }

       
    }

    public function logout(){
            Auth::logout();
            return  redirect()->route('login');
    }
}
