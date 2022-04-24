<?php

namespace App\Http\Controllers;

use App\Models\abc_form;
use App\Models\appointment;
use App\Models\incident_form;
use App\Models\medication;
use App\Models\Owner;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function index(){
        //Admin
        //list of users to authorise
        $adminListOfUsers = Owner::where('approved', 0)->where('deleted', 0)->get();
        //recently created users
        $adminCreatedUsersOwner = Owner::where('approved', 1)->where('deleted', 0)->orderBy('created_at')->get();
        $adminCreatedUsersStaff = Staff::where('approved', 1)->where('deleted', 0)->orderBy('created_at')->get();
        $adminCreatedUsers = $adminCreatedUsersOwner->merge($adminCreatedUsersStaff)->sortByDesc('created_at');
        //show two boxes for admin

        //owner and staff
        $companyCode = '';//If admin no need to load the other info
        if(Auth::guard('Owner')->check()){
            $companyCode = Auth::guard('Owner')->user()->companyCode;
        }else if(Auth::guard('Staff')->check()){
            $companyCode = Auth::guard('Staff')->user()->companyCode;
        }
        //appointments coming up for the last week
        $ownerStaffAppointments = appointment::where('resident.companyCode', $companyCode)->whereDate('appointment_date', '>=', Carbon::today())->join('resident', 'resident.id', '=', 'appointment.residentID')
        ->get(['appointment.id', 'resident.firstname','resident.companyCode', 'resident.lastname', 'appointment.appointment_address', 'appointment.appointment_details']);
        
        //med times coming up for this day
        $ownerStaffMedTimes = medication::where('resident.companyCode', $companyCode)->whereTime('medication.medication_times', '>=', Carbon::now('Europe/London')->format('H:i:s'))->orderBy('medication.medication_times')->join('resident', 'resident.id', '=', 'medication.residentID')
        ->get(['medication.id', 'medication.medication_name','resident.companyCode', 'medication.medication_times', 'resident.firstname', 'resident.lastname']);
        
        //alert if incident or abc form was made order by recent for a week
        $ownerStaffIncident = incident_form::where('resident.companyCode', $companyCode)->whereDate('incident_form.created_at', '<=', Carbon::today())->whereDate('incident_form.created_at', '>=', Carbon::today()->subDays(7))->join('resident', 'resident.id', '=', 'incident_form.residentID')->orderBy('incident_form.created_at')
        ->get(['incident_form.id','incident_form.outcome','resident.companyCode', 'resident.firstname', 'resident.lastname']); 

        $ownerStaffAbcForm = abc_form::where('resident.companyCode', $companyCode)->whereDate('abc_form.created_at', '<=', Carbon::today())->whereDate('abc_form.created_at', '>=', Carbon::today()->subDays(7))->orderBy('abc_form.created_at')->join('resident', 'resident.id', '=', 'abc_form.residentID')
        ->get(['abc_form.id','abc_form.consequence','resident.firstname','resident.lastname','resident.companyCode']);
        return view('regular.dashboard')->with('adminListOfUsers', $adminListOfUsers)->with('adminCreatedUsers', $adminCreatedUsers)
        ->with('ownerStaffAppointments', $ownerStaffAppointments)->with('ownerStaffMedTimes', $ownerStaffMedTimes)->with('ownerStaffIncidents', $ownerStaffIncident)
        ->with('ownerStaffFormAbc', $ownerStaffAbcForm);
    }
}
