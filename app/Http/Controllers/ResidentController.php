<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\resident;
use App\Models\medication;
use App\Models\abc_form;
use App\Models\incident_form;
use App\Models\appointment;
use Illuminate\Support\Facades\Auth;


class ResidentController extends Controller
{
    public function ResidentUpload(Request $request){
        if(!Auth::guard('Owner')->check()){
            return Redirect(Route('reidentForm'))->withErrors("Only an owner can create a resident.");
            
        }
        //dd($request);
        $medCount = $request->input('medCount');
        $messages = [
            'firstname.max' => 'Your first name is too long, Try again',
            "firstname.regex" => "Please only use letters for first name",

            "lastname.max" => "Your last name is too long ,Try again",
            "lastname.regex" => "Please only use letters for last name",

            "dob.date" => "please enter correct date format",
            "dob.before" =>  "resident must be older then 18",

            "doctor.max" => "Your doctors name is too long, Try again",
            "doctor.regex" => "Please only use letters for doctors name",

            "doctor_address.max" => "Doctors Address too long, Try again",

            "address.required" => "please enter an address",
            "address.max" => "Address too long, Try again",

            "careplan" => "please enter resident care plan",

            "mentalhealth" => "please enter resident mental health history",

            "physicalhealth" => "please enter resident physical health history",
        ];

        $rules = [
            'firstname' => 'max:100|regex:/^[a-zA-Z\s]*$/', 
            'lastname' => 'max:100|regex:/^[a-zA-Z\s]*$/', 
            'dob' => 'date|before:-18 years',
            'doctor' => 'max:100|regex:/^[a-zA-Z\s]*$/', 
            'doctor_address' => 'max:100',
            'address' => 'max:100|required',
            'careplan' => 'required', 
            'mentalhealth' => 'required', 
            'physicalhealth' => 'required',
        ];

        for($i =1; $i <= count((array)$medCount); $i++){
            $rules['medname' . $i] = 'max:100|regex:/^[a-zA-Z\s]*$/';
            $rules['meddose' . $i] = 'integer|max:500';
            $rules['medquant' . $i] = 'integer|max:10';
            $rules['medtime' . $i] = 'date_format:H:i';

            $messages['medname'. $i . '.max'] = 'Medication name is too long. Try again';
            $messages['medname'. $i . '.regex'] = 'Medication format is incorrect. Try again';

            $messages['meddose'. $i . '.max'] = 'Medication dose it too high. Try again';
            $messages['meddose'. $i . '.integer'] = 'Medication dose must be an int. Try again';

            $messages['medquant'. $i . '.max'] = 'Medication quantity it too high. Try again';
            $messages['medquant'. $i . '.integer'] = 'Medication quantity must be an int. Try again';

            $messages['medtime'. $i . '.date_format'] = 'Medication time is incorrect. Try again';
        }

        $request->validate($rules, $messages);
        $resident = new resident();
        $resident->companyCode =  Auth::guard('Owner')->user()->companyCode;
        $resident->firstname = $request->input('firstname');
        $resident->lastname = $request->input('surname');
        $resident->dob = $request->input('dob');
        $resident->doctor = $request->input('doc');
        $resident->doctor_address = $request->input('docadd');
        $resident->care_plan = $request->input('careplan');
        $resident->mental_health_history = $request->input('mentalhealth');
        $resident->physical_health_history = $request->input('physicalhealth');
        $resident->address = $request->input('address');
        $resident->save();
        for($i =1; $i <= count((array)$medCount); $i++){
            $medication = new medication();
            $medication->residentID = $resident->id;
            $medication->medication_name = $request->input('medname' . $i);
            $medication->medication_quantity = $request->input('medquant' . $i);
            $medication->medication_dose = $request->input('meddose' . $i);
            $medication->medication_times = $request->input('medtime' . $i);
            $medication->medication_type = $request->input('medtype' . $i);
            $medication->is_medication_required = $request->input('med_required' . $i);

            
            //do the rest
            $medication->save();
        }
        return Redirect(route('residentForm'))->with('success', "You have successfully created resident");
        
    }

    public function ABCUpload(Request $request){
        

        $messages = [];//error messages to display

        $request->validate([

            
        ],$messages);//validation for inputs
        if(!Auth::guard('Staff')->check()){
            return Redirect(route('reportIncident'))->with('error', "Only staff can create an ABC form.");
        }

        $abc = new abc_form();
        $abc->residentID = $request->input("resID");
        $abc->StaffID = Auth::guard('Staff')->user()->id;
        $abc->antecedent = $request->input("antecedent");
        $abc->behaviour = $request->input("behaviour");
        $abc->consequence = $request->input("consequence");
        $abc->save();
        return Redirect(route('reportIncident'))->with('success', "You have successfully created an ABC form");

        
    }
    public function incident_formUpload(Request $request){

        $messages = [];//error messages to display

        $request->validate([


        ],$messages);//validation for inputs
        $incident = new incident_form();
        $incident -> residentID = $request->input("resID");
        $incident->StaffID = Auth::guard('Staff')->user()->id;
        $incident -> incident = $request->input("incident");
        $incident -> outcome = $request->input("outcome");
        $incident -> is_staff_injured = $request->input("checkstaff") == 'on' ? 1 : 0;
        $incident -> is_resident_injured = $request->input("checkres") == 'on' ? 1 : 0;
        $incident -> injury_details = $request->input("injdetails");
        $incident -> behaviour = $request->input("resbehaviour");
        $incident -> escalation = $request->input("escalation");
        $incident -> call_details = $request->input("callinfo");
        $incident->save();
        return Redirect(route('reportIncident'))->with('success', "You have successfully created an incident report");

        
    }
    public function appointmentUpload(Request $request){

        $messages = [
            "appointmentAddress.required" => "please enter appointment address",

            "appointmentDetails.required" => "please enter appointment details",

            "appointmentDate.required" => "please enter appointment date",
            "appointmentDate.date" => "please enter valid date",
            "appointmentDate.date_format" => "please enter data in a valid format date",
            "appointmentDate.after" => "date has already passed, Please try",
        ];

        $rules = [
            'appointmentAddress' => 'required', 
            'appointmentDetails' => 'required', 
            'appointmentDate' => 'required|date|date_format:Y-m-d|after:yesterday',
        ];
        $residentID = $request->input('residentID');
        $request->validate($rules, $messages);
        $appointment = new appointment();
        $appointment -> residentID = $residentID;
        $appointment -> appointment_address = $request->input("appointmentAddress");
        $appointment -> appointment_details = $request->input("appointmentDetails");
        $appointment -> appointment_date = $request->input("appointmentDate");
        $appointment->save();
        return redirect(route('sessionForm', ['id' => $residentID]))->with('success', "You have successfully created an appointment");

        
    }


    public function ResidentEdit($id=null, ){
        $residents = resident::all();
        if(is_null($id)){
            return view('regular.residentEdit')->with('residents', $residents);
        }   

        
        $resident = resident::where('id', $id)->where('companyCode', Auth::guard('Staff')->user()->companyCode)->get();
        if(is_null($resident)){
            return view('regular.residentEdit')->with('residents', $residents)->with('error', 'This user is not a part of your company.');
        }
        $medications = medication::where('residentID', $id)->get();


        if(count($resident) > 0) $resident = $resident[0];
        return view('regular.residentEdit')->with('residents', $residents)->with('residentVal', $resident)->with('medications', $medications);
    }

    public function residentUpdate(Request $request){
        $residentID = $request->input('residentID');
        $medCount = $request->input('medCount');
        $messages = [
            'firstname.max' => 'Your first name is too long, Try again',
            "firstname.regex" => "Please only use letters for first name",

            "lastname.max" => "Your last name is too long ,Try again",
            "lastname.regex" => "Please only use letters for last name",

            "dob.date" => "please enter correct date format",
            "dob.before" =>  "resident must be older then 18",

            "doctor.max" => "Your doctors name is too long, Try again",
            "doctor.regex" => "Please only use letters for doctors name",

            "doctor_address.max" => "Doctors Address too long, Try again",

            "address.required" => "please enter an address",
            "address.max" => "Address too long, Try again",

            "careplan.required" => "please enter resident care plan",

            "mentalhealth.required" => "please enter resident mental health history",

            "physicalhealth.required" => "please enter resident physical health history",
        ];

        $rules = [
            'firstname' => 'max:100|regex:/^[a-zA-Z\s]*$/', 
            'lastname' => 'max:100|regex:/^[a-zA-Z\s]*$/', 
            'dob' => 'date|before:-18 years',
            'doctor' => 'max:100|regex:/^[a-zA-Z\s]*$/', 
            'doctor_address' => 'max:100',
            'address' => 'max:100|required',
            'careplan' => 'required', 
            'mentalhealth' => 'required', 
            'physicalhealth' => 'required',
        ];

        for($i =1; $i <= count((array)$medCount); $i++){
            $rules['medname' . $i] = 'max:100|regex:/^[a-zA-Z\s]*$/';
            $rules['meddose' . $i] = 'integer|max:500';
            $rules['medquant' . $i] = 'integer|max:10';
            $rules['medtime' . $i] = 'date_format:H:i';

            $messages['medname'. $i . '.max'] = 'Medication name is too long. Try again';
            $messages['medname'. $i . '.regex'] = 'Medication format is incorrect. Try again';

            $messages['meddose'. $i . '.max'] = 'Medication dose it too high. Try again';
            $messages['meddose'. $i . '.integer'] = 'Medication dose must be an int. Try again';

            $messages['medquant'. $i . '.max'] = 'Medication quantity it too high. Try again';
            $messages['medquant'. $i . '.integer'] = 'Medication quantity must be an int. Try again';

            $messages['medtime'. $i . '.date_format'] = 'Medication time is incorrect. Try again';
        }

        $request->validate($rules, $messages);

        $id = $request->input('residentID');
        $updatedValues = [
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('surname'),
            'dob' => $request->input('dob'),
            'doctor' => $request->input('doc'),
            'doctor_address' => $request->input('docadd'),
            'care_plan' => $request->input('careplan'),
            'mental_health_history' => $request->input('mentalhealth'),
            'physical_health_history' => $request->input('physicalhealth'),
            'address' => $request->input('address')
        ];
        
        if($request->has('resimage')){
            //update the image
        }
        resident::where('id', $id)->update($updatedValues);//can't update without loading so this is secure

        $medIDs = [];
        for($i=1; $i <=$medCount;$i++){
            if($request->input('medID'.$i) == '-1'){
                //create record and add id to medIDs when done
                $newMedication = new medication;
                $newMedication->residentID = $residentID;
                $newMedication->medication_name = $request->input('medname'. $i);
                $newMedication->medication_quantity = $request->input('medquant'. $i);
                $newMedication->medication_dose = $request->input('meddose'. $i);
                $newMedication->medication_times = $request->input('medtime'. $i);
                $newMedication->is_medication_required = $request->input('med_required'. $i);
                $newMedication->medication_type = $request->input('medtype'. $i);
                $newMedication->save();
                array_push($medIDs, $newMedication->id);

            }else{
                //update record and add id
                $updateMedication = medication::where('residentID', $residentID)->where('id', $request->input('medID'.$i));
                $updateMedication->update([
                    'medication_name' => $request->input('medname'. $i),
                    'medication_quantity' => $request->input('medquant'. $i),
                    'medication_dose' => $request->input('meddose'. $i),
                    'medication_times' => $request->input('medtime'. $i),
                    'is_medication_required' => $request->input('med_required'. $i),
                    'medication_type' => $request->input('medtype'. $i),
                ]);
                array_push($medIDs, $request->input('medID'.$i));
            }
        }

        //get all medication records for user id and if its id is not in $medIDs delete it
        medication::where('residentID', $residentID)->whereNotIn('id', $medIDs)->delete();

        
        return Redirect(route('residentEdit', ['id' => $id]))->with('success', "You have successfully updated the resident infomation");

        
    }
}