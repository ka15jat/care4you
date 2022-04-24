@extends('layouts.mainCentered')

@section('Content')

    <div class="container-fluid">
        <div class='row mx-auto'>
            <div class='col-sm-6 col-12 col-xs-12'
                style="background-color:var(--darkbg); min-height:75vh; max-height:75vh; overflow-y:auto;">
                <div class='orange'>
                    @if (\Auth::guard('Admin')->check())
                        <h4 class='mx-auto'>Unauthorised users</h4>
                        @foreach ($adminListOfUsers as $unauthorisedUser)
                            <p>{{ $unauthorisedUser->id }} {{ $unauthorisedUser->username }} Name:
                                {{ $unauthorisedUser->firstname }} {{ $unauthorisedUser->lastname }}</p>
                        @endforeach
                    @else
                        <h4>Upcoming appointments</h4>
                        @foreach ($ownerStaffAppointments as $appointment)
                            <p>{{ $appointment->id }} Resident Name {{ $appointment->firstname }}
                                {{ $appointment->lastname }}, Appointment Infomation:
                                {{ $appointment->appointment_address }}, {{ $appointment->appointment_details }}</p>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class='col-sm-6 col-xs-12'>
                @if (\Auth::guard('Admin')->check())
                    <div style="background-color:var(--darkbg); min-height: 75vh;max-height:75vh; overflow-y:auto;">
                        <h4 class='mx-auto'>Recently created users</h4>
                        @foreach ($adminCreatedUsers as $recentCreatedUsers)
                            <p>{{$recentCreatedUsers->id}} username: {{$recentCreatedUsers->username}} name: {{$recentCreatedUsers->firstname}} {{$recentCreatedUsers->lastname}}, Created at: {{$recentCreatedUsers->created_at}}</p>
                        @endforeach
                    </div>
                @else
                    <div
                        style="margin-bottom:10px; background-color:var(--darkbg); min-height: 37vh;max-height:37vh; overflow-y:auto;">
                        <h4>Upcoming med times</h4>
                        @foreach ($ownerStaffMedTimes as $medTimes)
                            <p>{{ $medTimes->id }} Resident Name: {{ $medTimes->firstname }} {{ $medTimes->lastname }},
                                {{ $medTimes->medication_name }} Time:{{ $medTimes->medication_times }}</p>
                        @endforeach
                    </div>
                    <div style="background-color:var(--darkbg); min-height: 37vh;max-height:37vh; overflow-y:auto;">
                        <h4>Previous incidents</h4>
                        @foreach ($ownerStaffIncidents as $incident)
                            <p>{{ $incident->id }} Resident Name: {{ $incident->firstname }} {{ $incident->lastname }}
                                Outcome: {{ $incident->outcome }}</p>
                        @endforeach
                        <h4>Previous ABC forms</h4>
                        @foreach ($ownerStaffFormAbc as $ownerStaffAbcForm)
                            <p>{{ $ownerStaffAbcForm->id }} Resident Name:
                                {{ $ownerStaffAbcForm->firstname }}{{ $ownerStaffAbcForm->lastname }}, consequence:
                                {{ $ownerStaffAbcForm->consequence }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
