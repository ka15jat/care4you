<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Owner;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AccountConfirmation extends Controller
{
    public function index(){
        //determine the user type 
        if(Auth::guard('Admin')->check()){
            $unapprovedUsers = new Collection;
            $unapprovedAdmins = Admin::where('approved', 0)->where('deleted', '!=', 1)->get();
            $unapprovedOwners = Owner::where('approved', 0)->where('deleted', '!=', 1)->get();
            foreach($unapprovedAdmins as $user){
                $user->accountType = 'Admin';
            }
            foreach($unapprovedOwners as $user){
                $user->accountType = 'Owner';
            }
            
            $unapprovedUsers = $unapprovedUsers->merge($unapprovedAdmins);
            $unapprovedUsers = $unapprovedUsers->merge($unapprovedOwners);
        }else if(Auth::guard('Owner')->check()){
            $unapprovedUsers = Staff::where('approved', 0)->where('deleted', '!=', 1)->where('companyCode', Auth::guard('Owner')->user()->companyCode)->get();
            foreach($unapprovedUsers as $user){
                $user->accountType = 'Staff';
            }
        }else{
            return Redirect(Route('login'))->withErrors("Wrong account type for account confirmation.");
        }
        return view('secure.accountConfirmation')->with('unapprovedUsers', $unapprovedUsers);
    } 

    public function approveAccount(Request $request){
        $accountType = $request->input('accountType');
        $id = $request->input('approveID');
        if($accountType == 'Owner'){
            Owner::where('id', $id)->update([
                'approved' => 1
            ]);
        }else if($accountType == 'Admin'){
            Admin::where('id', $id)->update([
                'approved' => 1
            ]);
        }else if($accountType == 'Staff'){
            Staff::where('id', $id)->update([
                'approved' => 1
            ]);
        }else{
            return Redirect(Route('accounts'))->withErrors("Wrong account type for approval.");
        }
        return Redirect(Route('accounts'))->with('success', "User was approved.");
    }

    public function declineAccount(Request $request){
        $accountType = $request->input('accountType');
        $id = $request->input('declineID');
        if($accountType == 'Owner'){
            Owner::where('id', $id)->update([
                'deleted' => 1
            ]);
        }else if($accountType == 'Admin'){
            Admin::where('id', $id)->update([
                'deleted' => 1
            ]);
        }else if($accountType == 'Staff'){
            Staff::where('id', $id)->update([
                'deleted' => 1
            ]);
        }else{
            return Redirect(Route('accounts'))->withErrors("Wrong account type for approval.");
        }
        return Redirect(Route('accounts'))->with('success', "User was declined and account deleted.");
    }
}
