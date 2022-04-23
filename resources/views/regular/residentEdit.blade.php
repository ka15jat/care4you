@extends('layouts.mainCentered')

@section('Content')
    <div class='container-fluid mx-auto' style='min-height:77vh; margin-top:1%;'>
        @isset($residentVal)
        <div class='row'>
            {{-- with the box and the image --}}
            
            <div class='col-md-10 ml-3' style='background-color:#00B4D8;min-height:100px;'>
               
                    <p>Resident ID: {{ $residentVal->id }}</p>
                    <p>Resident Name: {{ $residentVal->firstname }} {{ $residentVal->lastname }}</p>
                    <p> Resident Address: {{ $residentVal->address }}</p>
                
            </div>
            

            <img src='https://care4you.s3.eu-west-2.amazonaws.com/{{$residentVal->path}}' alt='Resident Image'
                style='width: 100px !important; min-height: 100px !important; padding:0px !important;margin-left:5%;' />
            
        </div>
        @endisset
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                aria-expanded="false">
                Please Select Resident
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                @foreach ($residents as $resident)
                    <li>
                        <a class="dropdown-item"
                            href="{{ route('residentEdit', ['id' => $resident->id]) }}">{{ $resident->id }}:
                            {{ $resident->firstname }} {{ $resident->lastname }}</a>
                    </li>
                @endforeach

            </ul>
        </div>
        <form method='POST' action='{{ route('residentUpdate') }}' enctype="multipart/form-data" id='residentForm'>
            @isset($residentVal)
                <input type='hidden' name='residentID' value='{{ $residentVal->id }}' />
            @endisset
            <div>
                {{-- the tabs one --}}
                <ul class="nav nav-tabs mt-2" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active show" id="pd-tab" data-bs-toggle="tab" data-bs-target="#pd"
                            type="button" role="tab" aria-controls="pd" aria-selected="true">Personal Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cp-tab" data-bs-toggle="tab" data-bs-target="#cp" type="button"
                            role="tab" aria-controls="cp" aria-selected="false">Care Plan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="mh-tab" data-bs-toggle="tab" data-bs-target="#mh" type="button"
                            role="tab" aria-controls="mh" aria-selected="false">Mental Health</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="ph-tab" data-bs-toggle="tab" data-bs-target="#ph" type="button"
                            role="tab" aria-controls="ph" aria-selected="false">Physical Health</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="medinfo-tab" data-bs-toggle="tab" data-bs-target="#medinfo"
                            type="button" role="tab" aria-controls="medinfo" aria-selected="false">Medication
                            Infomation</button>
                    </li>
                    <button class="btn btn-primary" type="submit" id='submitForm'>Edit Resident</button>
                </ul>
                @csrf
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="pd" role="tabpanel" aria-labelledby="pd-tab">
                        <div class='row justify-content-center align-self-center'>
                            <div class="mb-3 col-md-6">
                                <label for="firtname" class="form-label">First Name</label>
                                <input class="form-control" name='firstname' id="firstname"
                                    aria-describedby="firtnameHelp"
                                    @isset($residentVal) value="{{ $residentVal->firstname }}" @endisset
                                    required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="surname" class="form-label">Surname</label>
                                <input class="form-control" name='surname'
                                    @isset($residentVal) value="{{ $residentVal->lastname }}" @endisset
                                    id="surname" aria-describedby="surnameHelp" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input class="form-control" name='address'
                                    @isset($residentVal) value="{{ $residentVal->address }}" @endisset
                                    id="address" aria-describedby="addressHelp" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="dob" class="form-label">DOB</label>
                                <input type="date" class="form-control" name="dob"
                                    @isset($residentVal) value="{{ $residentVal->dob }}" @endisset
                                    id="dob" aria-describedby="dobHelp" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="doc" class="form-label">Doctor</label>
                                <input class="form-control" name="doc" id="doc"
                                    @isset($residentVal) value="{{ $residentVal->doctor }}" @endisset
                                    aria-describedby="docHelp" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="docadd" class="form-label">Doctors Address</label>
                                <input class="form-control" name="docadd" id="docadd"
                                    @isset($residentVal) value="{{ $residentVal->doctor_address }}" @endisset
                                    aria-describedby="docaddHelp" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="resimage">Resident image Upload</label>
                                {{-- not required but only update if present on backend --}}
                                <input type="file" class="form-control" name="resimage" id="resimage" />
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="cp" role="tabpanel" aria-labelledby="cp-tab">
                        <div class='row'>
                            <div class="mb-5 col-md-10 mx-auto">
                                <label for="cp" class="form-label">Care Plan</label>
                                <textarea class="form-control" name="careplan" id="cp" aria-describedby="cpHelp" rows=15 required>
@isset($residentVal)
{{ $residentVal->care_plan }}
@endisset
</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="mh" role="tabpanel" aria-labelledby="mh-tab">
                        <div class='row'>
                            <div class="mb-5 col-md-10 mx-auto">
                                <label for="mh" class="form-label">Mental Health</label>
                                <textarea class="form-control" name="mentalhealth" id="mh" aria-describedby="mhHelp" rows=15 required>
@isset($residentVal)
{{ $residentVal->mental_health_history }}
@endisset
</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="ph" role="tabpanel" aria-labelledby="ph-tab">
                        <div class='row'>
                            <div class="mb-5 col-md-10 mx-auto">
                                <label for="ph" class="form-label">Physical Health</label>
                                <textarea class="form-control" name="physicalhealth" id="ph" aria-describedby="phHelp" rows=15 required>
@isset($residentVal)
{{ $residentVal->mental_health_history }}
@endisset
</textarea>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="medinfo" role="tabpanel" aria-labelledby="medinfo-tab">
                        <h3 class="mx-auto">Medication</h3>
                        <div id='medicationDiv'>
                            @if (isset($medications))
                                @foreach ($medications as $i => $medication)
                                    <div class="mx-auto">
                                        <div class="row">
                                            <input type='hidden' name='medID{{ $i + 1 }}'
                                                value='{{ $medication->id }}' />
                                            <div class="row mt-3 mb-3 ml-3 mr-3 shadow-lg medication mx-auto col-12 p-3">
                                                <div
                                                    class="col-12 col-md-4 col-xl-3 col-lg-3 col-sm-12 col-xxl-2 justify-content-center d-flex">
                                                    <div class="justify-content-center align-self-center">
                                                        <label for="medname" class="form-label">Medication Name</label>
                                                        <input class="form-control" name='medname{{ $i + 1 }}'
                                                            id="medname" aria-describedby="mednameHelp" rows=5
                                                            value="{{ $medication->medication_name }}" required>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-2 justify-content-center d-flex">
                                                    <div class="justify-content-center align-self-center">
                                                        <label for="meddose" class="form-label">Medication Dose</label>
                                                        <input class="form-control" name="meddose{{ $i + 1 }}"
                                                            id="meddose" aria-describedby="meddoseHelp" rows=5
                                                            value="{{ $medication->medication_dose }}" required>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-2 justify-content-center d-flex">
                                                    <div class="justify-content-center align-self-center">
                                                        <label for="medquant" class="form-label">Medication
                                                            Quantity</label>
                                                        <input class="form-control" name="medquant{{ $i + 1 }}"
                                                            id="medquant" aria-describedby="medquantHelp" rows=5
                                                            value="{{ $medication->medication_quantity }}" required>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                                                    <div class="justify-content-center align-self-center">
                                                        <label for="medstime" class="form-label">Medication adminster
                                                            time</label>
                                                        <input type="time" class="form-control"
                                                            name="medtime{{ $i + 1 }}" id="medstime"
                                                            aria-describedby="medstimeHelp" rows=5
                                                            value="{{ \Carbon\Carbon::parse($medication->medication_times)->format('H:i') }}" required>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                                                    <div class="justify-content-center align-self-center">
                                                        <label for="medstime" class="form-label">Medication type</label>
                                                        <select class="form-select" name="medtype{{ $i + 1 }}"
                                                            aria-label="select">
                                                            <option value="Blister Pack"
                                                                @if ($medication->medication_type == 'Blister Pack') selected @endif>Blister
                                                                Pack</option>
                                                            <option value="Loose Box"
                                                                @if ($medication->medication_type == 'Loose Box') selected @endif>Loose Box
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                                                    <div class="justify-content-center align-self-center">
                                                        <label for="med_required" class="form-label">Medication
                                                            Required</label>
                                                        <select class="form-select"
                                                            name="med_required{{ $i + 1 }}"
                                                            aria-label="Default select">
                                                            <option value="Yes"
                                                                @if ($medication->is_medication_required == 'Yes') selected @endif>Yes
                                                            </option>
                                                            <option value="No"
                                                                @if ($medication->is_medication_required == 'No') selected @endif>No
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div
                                                        class="col-12 col-md-12 col-xl-12 col-lg-12 col-sm-12 col-xxl-12 justify-content-center d-flex mt-2">
                                                        <button type='button' class='btn btn-danger removeMeds'>Remove
                                                            Medication</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="mx-auto">
                                    <div class="row">

                                        <div class="row mt-3 mb-3 ml-3 mr-3 shadow-lg medication mx-auto col-12 p-3">
                                            <div
                                                class="col-12 col-md-4 col-xl-3 col-lg-3 col-sm-12 col-xxl-2 justify-content-center d-flex">
                                                <div class="justify-content-center align-self-center">
                                                    <label for="medname" class="form-label">Medication Name</label>
                                                    <input class="form-control" name='medname1' id="medname"
                                                        aria-describedby="mednameHelp" rows=5 required>
                                                </div>
                                            </div>
                                            <div
                                                class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-2 justify-content-center d-flex">
                                                <div class="justify-content-center align-self-center">
                                                    <label for="meddose" class="form-label">Medication Dose</label>
                                                    <input class="form-control" name="meddose1" id="meddose"
                                                        aria-describedby="meddoseHelp" rows=5 required>
                                                </div>
                                            </div>
                                            <div
                                                class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-2 justify-content-center d-flex">
                                                <div class="justify-content-center align-self-center">
                                                    <label for="medquant" class="form-label">Medication Quantity</label>
                                                    <input class="form-control" name="medquant1" id="medquant"
                                                        aria-describedby="medquantHelp" rows=5 required>
                                                </div>
                                            </div>
                                            <div
                                                class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                                                <div class="justify-content-center align-self-center">
                                                    <label for="medstime" class="form-label">Medication adminster
                                                        time</label>
                                                    <input type="time" class="form-control" name="medtime1" id="medstime"
                                                        aria-describedby="medstimeHelp" rows=5 required>
                                                </div>
                                            </div>
                                            <div
                                                class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                                                <div class="justify-content-center align-self-center">
                                                    <label for="medstime" class="form-label">Medication type</label>
                                                    <select class="form-select" name="medtype1" aria-label="select">
                                                        <option value="Blister Pack">Blister Pack
                                                        </option>
                                                        <option value="Loose Box">Loose Box
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div
                                                class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                                                <div class="justify-content-center align-self-center">
                                                    <label for="med_required" class="form-label">Medication
                                                        Required</label>
                                                    <select class="form-select" name="med_required1"
                                                        aria-label="Default select">
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-success mt-2 mb-2" id="addMedication">Add Medication</button>
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>

    <script>
        function addMedication() {
            let id = document.getElementById('medicationDiv').childElementCount + 1
            let elementContent = `<div class="row">
                                    <input type='hidden' name='medID${id}' value='-1'/>
                                <div class="row mt-3 mb-3 ml-3 mr-3 shadow-lg medication mx-auto col-12 p-3">
                                    <div
                                        class="col-12 col-md-4 col-xl-3 col-lg-3 col-sm-12 col-xxl-2 justify-content-center d-flex">
                                        <div class="justify-content-center align-self-center">
                                            <label for="medname" class="form-label">Medication Name</label>
                                            <input class="form-control medname" name='medname${id}' id="medname"
                                                aria-describedby="mednameHelp" rows=5 value="">
                                        </div>
                                    </div>
                                    <div
                                        class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-2 justify-content-center d-flex">
                                        <div class="justify-content-center align-self-center">
                                            <label for="meddose" class="form-label">Medication Dose</label>
                                            <input class="form-control meddose" name="meddose${id}" id="meddose"
                                                aria-describedby="meddoseHelp" rows=5 value="">
                                        </div>
                                    </div>
                                    <div
                                        class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-2 justify-content-center d-flex">
                                        <div class="justify-content-center align-self-center">
                                            <label for="medquant" class="form-label">Medication Quantity</label>
                                            <input class="form-control medquant" name="medquant${id}" id="medquant"
                                                aria-describedby="medquantHelp" rows=5 value="">
                                        </div>
                                    </div>
                                    <div
                                        class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                                        <div class="justify-content-center align-self-center">
                                            <label for="medstime" class="form-label">Medication adminster time</label>
                                            <input type="time" class="form-control medtime" name="medtime${id}" id="medstime"
                                                aria-describedby="medstimeHelp" rows=5 value="">
                                        </div>
                                    </div>
                                    <div
                                        class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                                        <div class="justify-content-center align-self-center">
                                            <label for="medstime" class="form-label">Medication type</label>
                                            <select class="form-select medtype" name="medtype${id}"
                                                aria-label="Default select example">
                                                <option value="Blister Pack">Blister Pack</option>
                                                <option value="Loose Box">Loose Box</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-xl-12 col-lg-12 col-sm-12 col-xxl-12 justify-content-center d-flex mt-2">
                                       <button class='btn btn-danger removeMeds'>Remove Medication</button>
                                    </div>
                                    <div
                                            class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                                            <div class="justify-content-center align-self-center">
                                                <label for="med_required" class="form-label">Medication Required</label>
                                                <select class="form-select" name="med_required${id}"
                                                    aria-label="Default select">
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                </div>
                            </div>`;
            let element = document.createElement('div');
            element.className = 'mx-auto';
            element.innerHTML = elementContent;
            document.querySelector('#medicationDiv').append(element)
            let removeMeds = document.querySelectorAll('.removeMeds');
            for (let i = 0; i < removeMeds.length; i++) {
                removeMeds[i].removeEventListener('click', removeMed);
                removeMeds[i].addEventListener('click', removeMed);
            }

        }

        let removeMeds = document.querySelectorAll('.removeMeds');
        for (let i = 0; i < removeMeds.length; i++) {
            removeMeds[i].removeEventListener('click', removeMed);
            removeMeds[i].addEventListener('click', removeMed);
        }

        function removeMed(e) {
            e.target.parentNode.parentNode.parentNode.parentNode.remove();
            let meds = document.getElementById('medicationDiv').children;
            for (let i = 1; i < meds.length; i++) { //i is 1 because first never changes
                meds[i].querySelector('.medname').setAttribute("name", `medname${i + 1}`);
                meds[i].querySelector('.meddose').setAttribute("name", `meddose${i + 1}`);
                meds[i].querySelector('.medquant').setAttribute("name", `medquant${i + 1}`);
                meds[i].querySelector('.medtime').setAttribute("name", `medtime${i + 1}`);
                meds[i].querySelector('.medtype').setAttribute("name", `medtype${i + 1}`);
                meds[i].querySelector('.med_required').setAttribute("name", `med_required${i + 1}`);
            }
        }

        function handleFormSubmit(e) {
            let medCount = document.getElementById('medicationDiv').children.length;
            let medCountElement = document.createElement('input');
            medCountElement.setAttribute('name', 'medCount')
            medCountElement.setAttribute('value', medCount)
            medCountElement.setAttribute('type', 'hidden')
            document.querySelector('#residentForm').appendChild(medCountElement)
        }

        document.querySelector('#addMedication').addEventListener('click', addMedication)
        document.querySelector('#submitForm').addEventListener('click', handleFormSubmit)
    </script>
@endsection
