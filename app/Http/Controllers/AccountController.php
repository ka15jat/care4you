<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Owner;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AccountController extends Controller
{
    public function login(Request $request){
        $username = $request->input('username');
        $userType = '';
        $adminUser = Admin::where('username', $username)->first();
        $staffUser = Staff::where('username', $username)->first();
        $ownerUser = Owner::where('username', $username)->first();
        if(!is_null($adminUser)){
            $user = $adminUser;
            $userType = 'Admin';
        }
        else if(!is_null($staffUser)){
            $user = $staffUser;
            $userType = 'Staff';
        }
        else if(!is_null($ownerUser)){
            $user = $ownerUser;
            $userType = 'Owner';
        }else{
            return Redirect(Route('login'))->withErrors("Login failed");
        }

        if(Hash::check(trim($request->input('password')), $user->password)){
            if($user->deleted == 1){
                return Redirect(Route('login'))->withErrors("You're account has been deleted");
            }
            if($user->approved == 0){
                return Redirect(Route('login'))->withErrors("You're account hasn't been activated yet. Please contact your admin.");
            }
        }
        
        Auth::guard('Admin')->logout();
        Auth::guard('Owner')->logout();
        Auth::guard('Staff')->logout();
        if (Auth::guard($userType)->attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {//hashes the password for me
            return Redirect(Route('dashboard'));
        }else{
            return Redirect(Route('login'))->withErrors("Login failed");
        }
    }

    public function register(Request $request){
        $messages = [
            'firstname.required' => 'Please enter your first name',
            'firstname.max' => 'Your first name is too long, Try again',
            "firstname.regex" => "Please only use letters for first name",

            "lastname.required" => "Please enter your last name",
            "lastname.max" => "Your last name is too long ,Try again",
            "lastname.regex" => "Please only use letters for last name",

            "username.required" => "Please Enter a valid username",
            "username.max" => "Username is too long try again",
            "username.min"=> "Username is too short try again",
            "username.unique"=> "Username already in use. Try again",

            "email.required" => "Please enter a valid email",
            "email.Email" => "Please make sure email is in the correct format",
            "email.max" => "Email is too long, try again",

            "password.required" => "Please enter a valid password",
            "password.max" => "Password is too long, Try again",
            "password.min" => "Password is too short, Try again",


            "cpassword.required" => "Please confirm the password",
            "cpassword.same" => "Password do not match, Try again",

            "accountType.required" => "Please select an account type",
        ];
        
        $accountType = $request->input('accountType');
        
        $request->validate([
            'firstname' => 'required|max:100|regex:/^[a-zA-Z\s]*$/', //Letters only
            'lastname' => 'required|max:100|regex:/^[a-zA-Z\s]*$/', //Letters only
            'username' => 'required|max:100|min:6',
            'email' => 'required|Email|max:100|Email',
            'password' => 'required|max:100|min:8',
            'cpassword' => 'required|same:password',
            'accountType' => 'required'
        ], $messages);

        $username = $request->input('username');
        $ownerCheck = Owner::where('username', $username)->first();
        $staffCheck = Staff::where('username', $username)->first();
        $adminCheck = Admin::where('username', $username)->first();
        if(!is_null($ownerCheck) || !is_null($staffCheck) || !is_null($adminCheck)){
            throw ValidationException::withMessages(['username' => 'That username is already taken.']);
        }

        $companyCodeVal = $request->input('companyCode');
        if($request->has('companyCode') && isset($companyCodeVal)){
            $ownerCheck = owner::where('companyCode', $request->input('companyCode'))->first();
            if(is_null($ownerCheck)){
                throw ValidationException::withMessages(['company code' => 'The company code is incorrect.']);
            }
        }


        $accountType = $request->input('accountType');
        if($accountType == 'Admin'){
            $user = new Admin();
        }else if($accountType == 'Staff'){
            $user = new Staff();
        }else if($accountType == 'Owner'){
            $user = new Owner();
        }else{
            return Redirect(Route('register'))->withErrors("Login failed");
        }
       
        $user->username = $request->input('username');
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        if($request->has('companyCode') && isset($companyCodeVal)){
            $user->companyCode = $request->input('companyCode');
        }if($accountType == 'Owner'){
            $user->companyCode = Str::uuid();
        }else if($accountType == 'Admin'){
            $user->companyCode = null;
        }
        $user->approved = 0;
        $user->deleted = 0;
        $user->save();
        return Redirect(route('login'))->with('success', "You have successfully registered");
    }

    public function logout(){//rewrite this for all guards and changhe the route to login
        if (Auth::guard('Admin')->check()) {
            Auth::guard('Admin')->logout();
            return redirect()->route('login')->with("success", "Logged out. Admin");

        } else if (Auth::guard('Staff')->check()) {
            Auth::guard('Staff')->logout();
            return redirect()->route('login')->with("success", "Logged out. Staff");

        } else if (Auth::guard('Owner')->check()) {
            Auth::guard('Owner')->logout();
            return redirect()->route('login')->with("success", "Logged out. Owner");
        }
        return redirect()->route('login')->with('error', 'Logout Unsuccessful.');
    }
}