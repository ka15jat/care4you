<?php

namespace App\Http\Controllers;

use App\Models\abc_form;
use App\Models\appointment;
use App\Models\incident_form;
use App\Models\medication;
use Illuminate\Http\Request;
use App\Models\resident;
use App\Models\session_form;
use App\Models\medication_given;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function index($id=null){
        $residents = resident::all();
        if(is_null($id)){
           return view('regular.residentSessionForm')->with('residents', $residents); 
        }

        $resCheck = resident::where('id', $id)->where('companyCode', Auth::guard('Staff')->user()->companyCode)->get();
        if(is_null($resCheck)){
            return view('regular.residentSessionForm')->with('residents', $residents)->with('error', 'This resident is not a resident within this company.'); 
        }

        $sessionForm = session_form::where('residentID', $id)->get();
        $incidents = incident_form::where('residentID', $id)->whereDate('created_at', Carbon::today())->get();
        $abcForms = abc_form::where('residentID', $id)->whereDate('created_at', Carbon::today())->get();
        $medications = medication::where('residentID', $id)->leftJoin('medication_given', function($join){
            $join->on('medication_given.MedicationID', '=', 'medication.id')->whereDate('medication_given.created_at', Carbon::today());
        })->get(['medication.id', 'medication.medication_name', 'medication.medication_quantity','medication.medication_dose','medication.medication_times',
        'medication.is_medication_required','medication.medication_type', 'medication_given.medication_remaining',
        'medication_given.medication_quantity_given','medication_given.time_administred']);
        $appointments = appointment::where('residentID', $id)->whereDate('appointment_date', Carbon::today())->get();

        $resident = resident::find($id);

        if(count($sessionForm) > 0) $sessionForm = $sessionForm[0];
        return view('regular.residentSessionForm')->with('residents',$residents)->with('sessionForm', $sessionForm)
        ->with('residentID', $id)->with('incidents', $incidents)->with('abcForms', $abcForms)->with('medications', $medications)
        ->with('resident', $resident)->with('appointments', $appointments);
    }

    public function handleSession(Request $request){

        $id =$request->input('residentID');
        $session = session_form::where('residentID', $id);
        $appCount = $request->input('appointmentCount');
        $medCount = $request->input('medCount');
        $sessionCheck = $session->get();
        $values = [];
        if($request->has('morningActivity')){
            $values['activityMorning'] = $request->input('morningActivity');
        }
        if($request->has('middayActivity')){
            $values['activityMidday'] = $request->input('middayActivity');
        }
        if($request->has('afternoonActivity')){
            $values['activityAfternoon'] = $request->input('afternoonActivity');
        }
        if($request->has('eveningActivity')){
            $values['activityEvening'] = $request->input('eveningActivity');
        }


        if($request->has('morningMood')){
            $values['moodMorning'] = $request->input('morningMood');
        }
        if($request->has('middayMood')){
            $values['moodMidday'] = $request->input('middayMood');
        }
        if($request->has('afternoonMood')){
            $values['moodAfternoon'] = $request->input('afternoonMood');
        }
        if($request->has('eveningMood')){
            $values['moodEvening'] = $request->input('eveningMood');
        }

        if($request->has('breakfast')){
            $values['breakfast'] = $request->input('breakfast');
        }
        if($request->has('lunch')){
            $values['lunch'] = $request->input('lunch');
        }
        if($request->has('dinner')){
            $values['dinner'] = $request->input('dinner');
        }
        if($request->has('snacks')){
            $values['snacks'] = $request->input('snacks');
        }

        if($request->has('showercheck')){
            $values['has_showered'] = true;
        }
        if($request->has('brushedteethcheck')){
            $values['has_brushed_teeth'] = true;
        }
        if($request->has('changedcheck')){
            $values['has_changed_clothes'] = true;
        }



        if($request->has('cleaningDone')){
            $values['cleaning_completed_today'] = $request->input('cleaningDone');
        }
        if($request->has('cleaningRequired')){
            $values['cleaning_required'] = $request->input('cleaningRequired');
        }

        if($request->has('handover')){
            $values['handover'] = $request->input('handover');
        }
        if($request->has('residentSupport')){
            $values['staff_support'] = $request->input('residentSupport');
        }
            //appointmen 
           for($i =1; $i <= $appCount; $i++){
                $appvalues = [];
                
                $appointmentID = $request->input('appointmentID'.$i);
                if($request->has('attendedcheck'.$i)){
                    $appvalues['attended'] = true;
                }
                
                if($request->has('notattended'.$i)){
                    $appvalues['reason_for_not_attending'] = $request->input('notattended'.$i);
                }

                if($request->has('appoutcome'.$i)){
                    $appvalues['appointment_outcome'] = $request->input('appoutcome'.$i);
                }
                appointment::where('id', $appointmentID)->update($appvalues);
            }
            for($i =1; $i <= $medCount; $i++){
                $medicationID = $request->input('medID'.$i);
                var_dump($medicationID);
                $remain = $request->input('medremain'.$i);
                $given = $request->input('medgiven'.$i);
                var_dump($remain);
                var_dump($given);
                if(!is_null($medicationID) && isset($remain) && isset($given)){
                    $medGiven = new medication_given;
                    $medGiven->medicationID = $medicationID;
        
                    if($request->has('medremain'.$i)){
                        $medGiven->medication_remaining = $request->input('medremain'.$i);
                    }
                    if($request->has('medgiven'.$i)){
                        $medGiven->medication_quantity_given = $request->input('medgiven'.$i);
                    }
                    if($request->has('medtime'.$i)){
                        $medGiven->time_administred = Carbon::parse(Carbon::today()->format('m/d/Y') . ' ' .  $request->input('medtime'.$i))->format('d/m/y H:i');
                    }
                    $medGiven ->save();
                }
                
            }
            //dd($medCount);


        $values['residentID'] = $id;
        if(count($sessionCheck) == 0){
            $sessionVal = new session_form($values);
            $sessionVal->save();
            return redirect(route('sessionForm', ['id' => $id]))->with('success', 'Session form created.');
        }else{
            $session->update($values);
            return redirect(route('sessionForm', ['id' => $id]))->with('success', 'Session form updated.');
        }

        
    }
}
