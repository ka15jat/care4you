@extends('layouts.mainCentered')

@section('Content')
    <div class='' style="">
        {{-- the tabs one --}}
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="incident-report-tab" data-bs-toggle="tab"
                    data-bs-target="#incident-report" type="button" role="tab" aria-controls="incident-report"
                    aria-selected="true" >Incident Report</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="abc-chart-tab" data-bs-toggle="tab" data-bs-target="#abc-chart"
                    type="button" role="tab">ABC Chart</button>
            </li>
        </ul>
        @csrf
        <div class="tab-content" id="myTabContent" style='min-height:70vh;'>
            <div class="tab-pane fade active show" id="incident-report" role="tabpanel"
                aria-labelledby="incident-report-tab">
                <form class='row' method='POST' action='{{ route('incident_formUpload') }}'>
                    <div class="mb-3 col-md-6">
                        <label for="resID" class="form-label">Resident ID</label>
                        <input class="form-control" name="resID" id="resID" aria-describedby="resIDHelp" required />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="incident" class="form-label">Incident</label>
                        <textarea class="form-control" name="incident" id="incident" aria-describedby="incidentHelp" required></textarea>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="outcome" class="form-label">Outcome</label>
                        <textarea class="form-control" name="outcome" id="outcome" aria-describedby="outcomeHelp" required></textarea>
                    </div>
                    <div class="mb-3 col-md-6">
                        <input type="checkbox" class="form-check-input" name="checkres" id="checkres">
                        <label class="form-check-label" for="checkres">Was resident injured</label>
                        <input type="checkbox" class="form-check-input" name="checkstaff" id="checkstaff">
                        <label class="form-check-label" for="checkstaff">Was Staff injured</label>
                        <label for="injdetails" class="form-label">Injury Details</label>
                        <input class="form-control" name="injdetails" id="injdetails" aria-describedby="injdetailsHelp" />

                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="resbehaviour" class="form-label">Resident Behaviour</label>
                        <input class="form-control" name="resbehaviour" id="resbehaviour" aria-describedby="resbehaviourHelp" required />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="callinfo" class="form-label">Call Details</label>
                        <input class="form-control" name="callinfo" id="callinfo" aria-describedby="callinfoHelp" required />
                    </div>
                    <div class="col-12 col-md-4 col-xl-4 col-lg-4 col-sm-12 col-xxl-6 justify-content-center d-flex">
                        <div class="justify-content-center align-self-center">
                            <label for="escalation" class="form-label">Was the situation escalated?</label>
                            <select class="form-select" name="escalation" aria-label="select" style='width:300px;'>
                                <option name="seniorstaff_called" value="Senior Staff">Senior Staff</option>
                                <option name="police_called" value="Police">Police</option>
                                <option name="hospital_called" value="Hospital">Hospital</option>

                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                     @csrf
                </form>
            </div>
            
            <div class="tab-pane fade" id="abc-chart" role="tabpanel" aria-labelledby="abc-chart-tab">
                <form class='row' method='POST' action='{{ route('ABCUpload')}}'>
                    @csrf
                    <div class="mb-3 col-md-6">
                        <label for="resID" class="form-label">Resident ID</label>
                        <input class="form-control" name="resID" id="resID" aria-describedby="resIDHelp" required />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="antecedent" class="form-label">Antecedent</label>
                        <textarea class="form-control" name="antecedent" id="antecedent" aria-describedby="antecedentHelp" required></textarea>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="behaviour" class="form-label">Behaviour</label>
                        <textarea class="form-control" name="behaviour" id="behaviour" aria-describedby="behaviourHelp" required></textarea>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="consequence" class="form-label">Consequence</label>
                        <textarea class="form-control" name="consequence" id="consequence" aria-describedby="consequenceHelp" required></textarea>
                        
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    
                </form>
            </div>
        </div>
       
    </div>
@endsection
