@extends('layouts.mainCentered')

@section('Content')
    <div class='container-fluid mx-auto' style='min-height:77vh; margin-top:1%;'>
        @isset($resident)
            <div class='row'>
                {{-- with the box and the image --}}
                <div class='col-md-10 ml-3' style='background-color:#00B4D8;min-height:100px;'>
                    <div class='col-md-10 ml-3' style='background-color:#00B4D8;min-height:100px;'>
                        <p>Resident ID: {{ $resident->id }}</p>
                        <p>Resident Name: {{ $resident->firstname }} {{ $resident->lastname }}</p>
                        <p> Resident Address: {{ $resident->address }}</p>
                    </div>
                </div>
                <img src='https://care4you.s3.eu-west-2.amazonaws.com/{{$resident->path}}' alt='Resident Image'
                    style='width: 100px !important; min-height: 100px !important; padding:0px !important;margin-left:5%;' />
            </div>
        @endisset
        <form action="{{ route('updateSessionForm') }}" method="POST" id='sessionForm'>
            @isset($residentID)
                <input type="hidden" name='residentID' value="{{ $residentID }}" />
            @endisset
            @csrf
            {{-- the tabs one --}}
            <ul class="nav nav-tabs mt-2" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity"
                        type="button" role="tab" aria-controls="activity" aria-selected="true">Activity</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="mood-tab" data-bs-toggle="tab" data-bs-target="#mood" type="button"
                        role="tab" aria-controls="mood" aria-selected="false">Mood</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="meals-tab" data-bs-toggle="tab" data-bs-target="#meals" type="button"
                        role="tab" aria-controls="meals" aria-selected="false">Meals</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="personal-hygine-tab" data-bs-toggle="tab"
                        data-bs-target="#personal-hygine" type="button" role="tab" aria-controls="personal-hygine"
                        aria-selected="false">Personal Hygine</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="cleaning-tab" data-bs-toggle="tab" data-bs-target="#cleaning"
                        type="button" role="tab" aria-controls="cleaning" aria-selected="false">Cleaning</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="handover-tab" data-bs-toggle="tab" data-bs-target="#handover"
                        type="button" role="tab" aria-controls="handover" aria-selected="false">Handover</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="medication-tab" data-bs-toggle="tab" data-bs-target="#medication"
                        type="button" role="tab" aria-controls="medication" aria-selected="false">Medication</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="apps-tab" data-bs-toggle="tab" data-bs-target="#apps" type="button"
                        role="tab" aria-controls="apps" aria-selected="false">Appointments</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="incident-tab" data-bs-toggle="tab" data-bs-target="#incident"
                        type="button" role="tab" aria-controls="incident" aria-selected="false">Incident</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="abc-tab" data-bs-toggle="tab" data-bs-target="#abc" type="button"
                        role="tab" aria-controls="abc" aria-selected="false">ABC</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sign-tab" data-bs-toggle="tab" data-bs-target="#sign" type="button"
                        role="tab" aria-controls="sign" aria-selected="false">Sign</button>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Please Select Resident
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                            @foreach ($residents as $residentVal)
                                <li>
                                    <a class="dropdown-item" href={{route('sessionForm', ['id' => $residentVal->id])}}>{{ $residentVal->id }}:
                                        
                                        {{ $residentVal->firstname }} {{ $residentVal->lastname }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                @isset($residentID)
                    <li class="nav-item" role="presentation">
                        <button type="submit" class="btn btn-primary" id='submitBtn'  @isset($disabledSession){{$disabledSession}}@endisset>Submit</button>
                    </li>
                @endisset

            </ul>


            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                    <div class='row'>
                        <div class="mb-3 col-md-6">
                            <label for="morning" class="form-label">Morning</label>
                            <textarea class="form-control" id="morningActivity" name="morningActivity" aria-describedby="morningHelp" rows=5 @isset($disabledSession){{$disabledSession}}@endisset>
@isset($sessionForm->activityMorning)
{{ $sessionForm->activityMorning }}
@endisset
</textarea>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="midday" class="form-label">Midday</label>
                            <textarea class="form-control" id="middayActivity" name="middayActivity" aria-describedby="middayHelp" rows=5 @isset($disabledSession){{$disabledSession}}@endisset>
@isset($sessionForm->activityMidday)
{{ $sessionForm->activityMidday }}
@endisset
</textarea>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="afternoon" class="form-label">Afternoon</label>
                            <textarea class="form-control" id="afternoonActivity" name="afternoonActivity" aria-describedby="afternoonHelp"
                                rows=5 @isset($disabledSession){{$disabledSession}}@endisset>
@isset($sessionForm->activityAfternoon)
{{ $sessionForm->activityAfternoon }}
@endisset
</textarea>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="evening" class="form-label">Evening</label>
                            <textarea class="form-control" id="eveningActivity" name="eveningActivity" aria-describedby="eveningHelp" rows=5 @isset($disabledSession){{$disabledSession}}@endisset>
@isset($sessionForm->activityEvening)
{{ $sessionForm->activityEvening }}
@endisset
</textarea>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="mood" role="tabpanel" aria-labelledby="mood-tab">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="morning" class="form-label">Morning</label>
                            <textarea class="form-control" id="moodmorning" name="morningMood" aria-describedby="morningHelp" rows=5 @isset($disabledSession){{$disabledSession}}@endisset>
@isset($sessionForm->moodMorning)
{{ $sessionForm->moodMorning }}
@endisset
</textarea>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="midday" class="form-label">Midday</label>
                            <textarea class="form-control" id="moodmidday" name="middayMood" aria-describedby="middayHelp" rows=5 @isset($disabledSession){{$disabledSession}}@endisset>
@isset($sessionForm->moodMidday)
{{ $sessionForm->moodMidday }}
@endisset
</textarea>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="afternoon" class="form-label">Afternoon</label>
                            <textarea class="form-control" id="moodafternoon" name="afternoonMood" aria-describedby="afternoonHelp" rows=5 @isset($disabledSession){{$disabledSession}}@endisset>
@isset($sessionForm->moodAfternoon)
{{ $sessionForm->moodAfternoon }}
@endisset
</textarea>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="evening" class="form-label">Evening</label>
                            <textarea class="form-control" id="moodevening" name="eveningMood" aria-describedby="eveningHelp" rows=5 @isset($disabledSession){{$disabledSession}}@endisset>
@isset($sessionForm->moodEvening)
{{ $sessionForm->moodEvening }}
@endisset
</textarea>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="meals" role="tabpanel" aria-labelledby="meals-tab">
                    <div class='row'>
                        <div class="mb-3 col-md-6">
                            <label for="breakfast" class="form-label">Breakfast</label>
                            <input class="form-control" id="breakfast" name="breakfast" aria-describedby="breakfastHelp"
                                rows=5
                                value="@isset($sessionForm->breakfast) {{ $sessionForm->breakfast }} @endisset" @isset($disabledSession){{$disabledSession}}@endisset>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lunch" class="form-label">Lunch</label>
                            <input class="form-control" id="lunch" name="lunch" aria-describedby="lunchHelp" rows=5
                                value="@isset($sessionForm->lunch) {{ $sessionForm->lunch }} @endisset" @isset($disabledSession){{$disabledSession}}@endisset>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="dinner" class="form-label">Dinner</label>
                            <input class="form-control" id="dinner" name="dinner" aria-describedby="dinnerHelp" rows=5
                                value="@isset($sessionForm->dinner) {{ $sessionForm->dinner }} @endisset" @isset($disabledSession){{$disabledSession}}@endisset>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="snacks" class="form-label">Snacks</label>
                            <input class="form-control" id="snacks" name="snacks" aria-describedby="snacksHelp" rows=5
                                value="@isset($sessionForm->snacks) {{ $sessionForm->snacks }} @endisset" @isset($disabledSession){{$disabledSession}}@endisset>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="personal-hygine" role="tabpanel" aria-labelledby="personal-hygine-tab">
                    <div class='row'>
                        <div class="mb-3 col-md-6">
                            <input type="checkbox" name="showercheck" class="form-check-input" id="showercheck"
                                @isset($sessionForm->has_showered) {{ $sessionForm->has_showered == 1 ? 'checked' : '' }} @endisset  @isset($disabledSession){{$disabledSession}}@endisset />
                            <label class="form-check-label" for="exampleCheck1">Showered</label>
                        </div>
                        <div class="mb-3 col-md-6">
                            <input type="checkbox" class="form-check-input" name="brushedteethcheck" id="brushedteethcheck"
                                @isset($sessionForm->has_brushed_teeth) {{ $sessionForm->has_brushed_teeth == 1 ? 'checked' : '' }} @endisset @isset($disabledSession){{$disabledSession}}@endisset/>
                            <label class="form-check-label" for="exampleCheck1">Brushed
                                Teeth</label>
                        </div>
                        <div class="mb-3 col-md-6">
                            <input type="checkbox" class="form-check-input" name="changedcheck" id="changedcheck"
                                @isset($sessionForm->has_changed_clothes) {{ $sessionForm->has_changed_clothes == 1 ? 'checked' : '' }} @endisset @isset($disabledSession){{$disabledSession}}@endisset/>
                            <label class="form-check-label" for="exampleCheck1">Changed
                                Clothes</label>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="cleaning" role="tabpanel" aria-labelledby="cleaning-tab">
                    <div class='row'>
                        <div class="mb-3 col-md-6">
                            <label for="cleaningdone" class="form-label">What Cleaning Has Been Done</label>
                            <textarea class="form-control" id="cleaningdone" name="cleaningDone" aria-describedby="cleaningdoneHelp" rows=5 @isset($disabledSession){{$disabledSession}}@endisset>
@isset($sessionForm->cleaning_completed_today)
{{ $sessionForm->cleaning_completed_today }}
@endisset
</textarea>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="cleaningrequired" class="form-label">What Cleaning is required</label>
                            <textarea class="form-control" id="cleaningrequired" name="cleaningRequired" aria-describedby="cleaningrequiredHelp"
                                rows=5  @isset($disabledSession){{$disabledSession}}@endisset>
@isset($sessionForm->cleaning_required)
{{ $sessionForm->cleaning_required }}
@endisset
</textarea>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="medication" role="tabpanel" aria-labelledby="medication-tab">
                    @isset($medications)
                        <div id='medicationDiv'>
                            @foreach ($medications as $i => $medication)
                                @php
                                    if (isset($medication->medication_quantity_given)){
                                        $disabled = 'disabled';
                                    } 
                                    else {
                                        $disabled = '';
                                    }
                                @endphp
                                <div class="CustomW75 mx-auto">
                                    <input type="hidden" name="medID{{ $i + 1 }}" value="{{ $medication->id }}" {{$disabled}} @isset($disabledSession){{$disabledSession}}@endisset/>
                                    <div class="row">
                                        <h3 class="mx-auto">Medication</h3>
                                        <div class="row mt-3 mb-3 ml-3 mr-3 shadow-lg unapprovedUsers mx-auto col-12 p-3">
                                            <div
                                                class="col-12 col-md-4 col-xl-3 col-lg-3 col-sm-12 col-xxl-2 justify-content-center d-flex">
                                                <div class="justify-content-center align-self-center">
                                                    <p> Medication name: {{ $medication->medication_name }}</p>
                                                    <p> Medication dose mg: {{ $medication->medication_dose }}</p>
                                                    <p> Medication quantity: {{ $medication->medication_quantity }}</p>
                                                </div>
                                            </div>
                                            <div
                                                class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-2 justify-content-center d-flex"
                                                id='medRemain'>
                                                <div class="justify-content-center align-self-center">
                                                    <label for="medsrem" class="form-label">Medication Remaining</label>
                                                    <input class="form-control" aria-describedby="medsremHelp"
                                                        rows=5
                                                        value="@if (!is_null($medication->medication_remaining)) {{ $medication->medication_remaining }} @endif"
                                                        name="medremain{{ $i + 1 }}" {{ $disabled }} @isset($disabledSession){{$disabledSession}}@endisset id='medRemain'>
                                                </div>
                                            </div>
                                            <div
                                                class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                                                <div class="justify-content-center align-self-center">
                                                    <label for="medsgiven" class="form-label">Medication Given </label>
                                                    <input class="form-control" id="medsgiven"
                                                        aria-describedby="medsgivenHelp" rows=5
                                                        value="@if (!is_null($medication->medication_quantity_given)) {{ $medication->medication_quantity_given}} @endif"
                                                        name="medgiven{{ $i + 1 }}" {{ $disabled }} @isset($disabledSession){{$disabledSession}}@endisset>
                                                </div>
                                            </div>
                                            <div
                                                class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                                                <div class="justify-content-center align-self-center">
                                                    <label for="medstime" class="form-label">Medication Time
                                                        Administred</label>
                                                    <input type="time" class="form-control" id="medstime"
                                                        aria-describedby="medstimeHelp" rows=5
                                                        value="@if(!is_null($medication->time_administred)){{ Carbon\Carbon::parse($medication->time_administred)->format('H:i')}}@endif"
                                                        name="medtime{{ $i + 1 }}" {{ $disabled }} @isset($disabledSession){{$disabledSession}}@endisset>
                                                </div>
                                            </div>
                                            <div
                                                class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-2 justify-content-center d-flex">
                                                <div class="justify-content-center align-self-center">
                                                    <p class="form-label">Medication type:
                                                        {{ $medication->medication_type }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endisset
                </div>
                <div class="tab-pane fade" id="handover" role="tabpanel" aria-labelledby="handover-tab">
                    <div class='row'>
                        <div class="mb-3 col-md-6">
                            <label for="handoverinfo" class="form-label">Handover infomation</label>
                            <textarea class="form-control" id="handoverinfo" name="handover" aria-describedby="handoverinfoHelp" rows=5 @isset($disabledSession){{$disabledSession}}@endisset>
@isset($sessionForm->handover)
{{ $sessionForm->handover }}
@endisset
</textarea>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="residentSupport" class="form-label">How have you supported the resident</label>
                            <textarea class="form-control" id="residentsupport" name="residentSupport" aria-describedby="residentSupportHelp"
                                rows=5 @isset($disabledSession){{$disabledSession}}@endisset>
@isset($sessionForm->staff_support)
{{ $sessionForm->staff_support }}
@endisset
</textarea>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="apps" role="tabpanel" aria-labelledby="apps-tab">
                    @isset($appointments)
                        <div id='appointmentDiv'>
                            @foreach ($appointments as $i => $appointment)
                                @php
                                    if (isset($appointment->attended) || isset($appointment->reason_for_not_attending) || isset($appointment->appointment_outcome)) {
                                        $disabled = 'disabled';
                                    } else {
                                        $disabled = '';
                                    }
                                @endphp
                                <div class='row mb-2 pb-2' style="background-color:var(--navBg)">
                                    <input type='hidden' name='appointmentID{{ $i + 1 }}'
                                        value='{{ $appointment->id }}'  @isset($disabledSession){{$disabledSession}}@endisset/>
                                    <div>
                                        <p>Appointments Details: {{ $appointment->appointment_details }}</p>
                                        <label class="form-check-label" for="check">Attended</label>
                                        <input type="checkbox" class="form-check-input"
                                            name="attendedcheck{{ $i + 1 }}" {{ $disabled }}
                                            @isset($appointment->attended) {{ $appointment->attended == 1 ? 'checked' : '' }} @endisset  @isset($disabledSession){{$disabledSession}}@endisset>
                                    </div>
                                    <div
                                        class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                                        <p>Appointments Address: {{ $appointment->appointment_address }}</p>
                                    </div>
                                    <div
                                        class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                                        <label for="medstime" class="form-label">Reason for not attending</label>
                                        <input class="form-control" id="noattended" name="notattended{{ $i + 1 }}"
                                            aria-describedby="medstimeHelp" rows=5 {{ $disabled }}  @isset($disabledSession){{$disabledSession}}@endisset
                                            value="@isset($appointment->reason_for_not_attending) {{ $appointment->reason_for_not_attending }} @endisset">
                                    </div>
                                    <div
                                        class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                                        <label for="medstime" class="form-label">Appointment outcome</label>
                                        <input class="form-control" id="medstime" name="appoutcome{{ $i + 1 }}"
                                            aria-describedby="medstimeHelp" rows=5 {{ $disabled }} @isset($disabledSession){{$disabledSession}}@endisset
                                            value="{{ $appointment->appointment_outcome }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal"
                            data-bs-target="#appointmentModal"  @isset($disabledSession){{$disabledSession}}@endisset>Add new appointment</button>
                    @endisset
                </div>
                <div class="tab-pane fade" id="incident" role="tabpanel" aria-labelledby="incident-tab">
                    @isset($incidents)
                        @foreach ($incidents as $i)
                            <div class='row m-2' style='background-color:#00B4D8;'>
                                <div class="mb-3 col-md-6">
                                    <label for="incident" class="form-label">Incident</label>
                                    <textarea class="form-control" name="incident" id="incident" aria-describedby="incidentHelp"
                                        disabled  @isset($disabledSession){{$disabledSession}}@endisset>{{ $i->incident }}</textarea>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="outcome" class="form-label">Outcome</label>
                                    <textarea class="form-control" name="outcome" id="outcome" aria-describedby="outcomeHelp"
                                        disabled  @isset($disabledSession){{$disabledSession}}@endisset>{{ $i->outcome }}</textarea>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <input type="checkbox" class="form-check-input" name="checkres" id="checkres"
                                        @if ($i->is_resident_injured == 1) {{ 'checked' }} @endif disabled  @isset($disabledSession){{$disabledSession}}@endisset/>
                                    <label class="form-check-label" for="checkres">Was resident injured</label>
                                    <input type="checkbox" class="form-check-input" name="checkstaff" id="checkstaff"
                                        @if ($i->is_staff_injured == 1) {{ 'checked' }} @endif disabled  @isset($disabledSession){{$disabledSession}}@endisset/>
                                    <label class="form-check-label" for="checkstaff">Was Staff injured</label>
                                    <div>
                                        <label for="injdetails" class="form-label">Injury Details</label>
                                        <input class="form-control" name="injdetails" id="injdetails"
                                            aria-describedby="injdetailsHelp" value="{{ $i->injury_details }}" disabled  @isset($disabledSession){{$disabledSession}}@endisset/>
                                    </div>

                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="resbehaviour" class="form-label">Resident Behaviour</label>
                                    <input class="form-control" name="resbehaviour" id="resbehaviour"
                                        aria-describedby="resbehaviourHelp" value="{{ $i->behaviour }}" disabled  @isset($disabledSession){{$disabledSession}}@endisset/>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="callinfo" class="form-label">Call Details</label>
                                    <input class="form-control" name="callinfo" id="callinfo"
                                        value="{{ $i->call_details }}" aria-describedby="callinfoHelp" disabled  @isset($disabledSession){{$disabledSession}}@endisset />
                                </div>
                                <div
                                    class="col-12 col-md-4 col-xl-4 col-lg-4 col-sm-12 col-xxl-6 justify-content-center d-flex">
                                    <div class="justify-content-center align-self-center">
                                        <label for="escalation" class="form-label">Was the situation escalated?</label>
                                        <select class="form-select mb-2" name="escalation" aria-label="select"
                                            style='width:300px;' disabled @isset($disabledSession){{$disabledSession}}@endisset>
                                            <option name="police_called" value="Police"
                                                @if ($i->escalation = 'Police') {{ 'selected' }} @endif>Police</option>
                                            <option name="hospital_called" value="Hospital"
                                                @if ($i->escalation = 'Hospital') {{ 'selected' }} @endif>Hospital
                                            </option>
                                            <option name="seniorstaff_called" value="Senior staff"
                                                @if ($i->escalation = 'Senior staff') {{ 'selected' }} @endif>Senior staff
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>

                <div class="tab-pane fade" id="abc" role="tabpanel" aria-labelledby="abc-tab">
                    @isset($abcForms)
                        @foreach ($abcForms as $i)
                            <div class='row m-2' style='background-color:#00B4D8;'>
                                <div class="mb-3 col-md-6">
                                    <label for="antecedent" class="form-label">Antecedent</label>
                                    <textarea class="form-control" name="antecedent" id="antecedent" aria-describedby="antecedentHelp"
                                        disabled @isset($disabledSession){{$disabledSession}}@endisset>{{ $i->antecedent }}</textarea>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="behaviour" class="form-label">Behaviour</label>
                                    <textarea class="form-control" name="behaviour" id="behaviour" aria-describedby="behaviourHelp"
                                        disabled @isset($disabledSession){{$disabledSession}}@endisset>{{ $i->behaviour }}</textarea>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="consequence" class="form-label">Consequence</label>
                                    <textarea class="form-control" name="consequence" id="consequence" aria-describedby="consequenceHelp"
                                        disabled @isset($disabledSession){{$disabledSession}}@endisset>{{ $i->consequence }}</textarea>

                                </div>

                            </div>
                        @endforeach
                    @endisset
                </div>
                <div class="tab-pane fade" id="sign" role="tabpanel" aria-labelledby="sign-tab">
                    <p>Confirm everything has been done and meds have all been Administred</p>
                    <div class='col-md-4 mx-auto'>
                        <label for="digsign" class="form-label">Digital Signature</label>
                        <input class="form-control" id="digsign" aria-describedby="digsignHelp" name="digsign" rows=5 @isset($disabledSession){{$disabledSession}}@endisset>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <script>

    </script>
    {{-- modals --}}
    <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModal" aria-hidden="true">
        <div class="modal-dialog">
            <form class='row' method='POST' action='{{ route('appointmentUpload') }}'>
                @isset($residentID)
                    <input type="hidden" name='residentID' value="{{ $residentID }}" />
                @endisset
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="justify-content-center align-self-center">
                            <label for="medstime" class="form-label">Appointment Details</label>
                            <input class="form-control" name="appointmentDetails" aria-describedby="medstimeHelp" rows=5>
                        </div>
                        <div class="justify-content-center align-self-center">
                            <label for="medstime" class="form-label">Appointment Address</label>
                            <input class="form-control" name="appointmentAddress"
                                aria-describedby="appointmentAddressHelp" rows=5>
                        </div>
                        <div class="justify-content-center align-self-center">
                            <label for="medstime" class="form-label">Appointment Date</label>
                            <input type="date" class="form-control" name="appointmentDate"
                                aria-describedby="appointmentDateHelp" rows=5>
                        </div>
                        @csrf

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Appointment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
        function handleFormSubmit(e) {
            let medCount = document.getElementById('medicationDiv').children.length;
            let medCountElement = document.createElement('input');

            medCountElement.setAttribute('name', 'medCount')
            medCountElement.setAttribute('value', medCount)
            medCountElement.setAttribute('type', 'hidden')
            document.getElementById('sessionForm').appendChild(medCountElement)

            let appointmentCount = document.getElementById('appointmentDiv').children.length;
            let appointmentCountElement = document.createElement('input');
            appointmentCountElement.setAttribute('name', 'appointmentCount')
            appointmentCountElement.setAttribute('value', appointmentCount)
            appointmentCountElement.setAttribute('type', 'hidden')
            document.getElementById('sessionForm').appendChild(appointmentCountElement)
        }
        document.querySelector('#submitBtn').addEventListener('click', handleFormSubmit)
    </script>
@endsection
