@extends('layouts.mainCentered')

@section('Content')
    <div class='container-fluid mx-auto mb-2' style='min-height:77vh; margin-top:1%; background-color:var(--navBg)'>
        <form method='POST' action='{{ route('residentUpload') }}' enctype="multipart/form-data" id='residentForm'>
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
                    <button class="btn btn-primary" type="submit" id='submitForm'>Submit</button>
                </ul>


                @csrf
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="pd" role="tabpanel" aria-labelledby="pd-tab">
                        <div class='row justify-content-center align-self-center'>
                            <div class="mb-3 col-md-6">
                                <label for="firtname" class="form-label">First Name</label>
                                <input class="form-control" name='firstname' id="firstname"
                                    aria-describedby="firtnameHelp" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="surname" class="form-label">Surname</label>
                                <input class="form-control" name='surname' id="surname" aria-describedby="surnameHelp"
                                    required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input class="form-control" name='address' id="address" aria-describedby="addressHelp"
                                    required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="dob" class="form-label">DOB</label>
                                <input type="date" class="form-control" name="dob" id="dob" aria-describedby="dobHelp"
                                    required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="doc" class="form-label">Doctor</label>
                                <input class="form-control" name="doc" id="doc" aria-describedby="docHelp" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="docadd" class="form-label">Doctors Address</label>
                                <input class="form-control" name="docadd" id="docadd" aria-describedby="docaddHelp"
                                    required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="resimage">Resident image Upload</label>
                                <input type="file" class="form-control" name="resimage" id="resimage" required />
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="cp" role="tabpanel" aria-labelledby="cp-tab">
                        <div class='row'>
                            <div class="mb-5 col-md-10 mx-auto">
                                <label for="cp" class="form-label">Care Plan</label>
                                <textarea class="form-control" name="careplan" id="cp" aria-describedby="cpHelp" rows=15 required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="mh" role="tabpanel" aria-labelledby="mh-tab">
                        <div class='row'>
                            <div class="mb-5 col-md-10 mx-auto">
                                <label for="mh" class="form-label">Mental Health</label>
                                <textarea class="form-control" name="mentalhealth" id="mh" aria-describedby="mhHelp" rows=15 required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="ph" role="tabpanel" aria-labelledby="ph-tab">
                        <div class='row'>
                            <div class="mb-5 col-md-10 mx-auto">
                                <label for="ph" class="form-label">Physical Health</label>
                                <textarea class="form-control" name="physicalhealth" id="ph" aria-describedby="phHelp" rows=15 required></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="medinfo" role="tabpanel" aria-labelledby="medinfo-tab">
                        <div id='medicationDiv'>
                            <div class="mx-auto">
                                <div class="row">
                                    <h3 class="mx-auto">Medication</h3>
                                    <div class="row mt-3 mb-3 ml-3 mr-3 shadow-lg medication mx-auto col-12 p-3">
                                        <div
                                            class="col-12 col-md-4 col-xl-3 col-lg-3 col-sm-12 col-xxl-2 justify-content-center d-flex">
                                            <div class="justify-content-center align-self-center">
                                                <label for="medname" class="form-label">Medication Name</label>
                                                <input class="form-control" name='medname1' id="medname"
                                                    aria-describedby="mednameHelp" rows=5 value="" required>
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-2 justify-content-center d-flex">
                                            <div class="justify-content-center align-self-center">
                                                <label for="meddose" class="form-label">Medication Dose mg:</label>
                                                <input class="form-control" name="meddose1" id="meddose"
                                                    aria-describedby="meddoseHelp" rows=5 value="" required>
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-2 justify-content-center d-flex">
                                            <div class="justify-content-center align-self-center">
                                                <label for="medquant" class="form-label">Medication Quantity</label>
                                                <input class="form-control" name="medquant1" id="medquant"
                                                    aria-describedby="medquantHelp" rows=5 value="" required>
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                                            <div class="justify-content-center align-self-center">
                                                <label for="medstime" class="form-label">Medication adminster
                                                    time</label>
                                                <input type="time" class="form-control" name="medtime1" id="medstime"
                                                    aria-describedby="medstimeHelp" rows=5 value="{{-- $medication->medication_name ?? '' --}}"
                                                    required>
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                                            <div class="justify-content-center align-self-center">
                                                <label for="medstime" class="form-label">Medication type</label>
                                                <select class="form-select" name="medtype1"
                                                    aria-label="Default select example">
                                                    <option value="Blister Pack">Blister Pack</option>
                                                    <option value="Loose Box">Loose Box</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                                            <div class="justify-content-center align-self-center">
                                                <label for="med_required" class="form-label">Medication Required</label>
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
                                            <label for="meddose" class="form-label">Medication Dose mg: </label>
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
