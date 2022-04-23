@extends('layouts.mainCentered')

@section("Content")

{{-- 
todo 
need to add deleted and approved to the middleware
For authorise user define a middleware for owner and admin since both can use
--}}
{{--<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
    <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
    <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee</div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">sssssssssssssssssssssssssssssssssssssssssssssssss</div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
</div>--}}
    <style>

        .unapprovedUsers {
            background-color: #2E9CCA;
            color: black;
        }

        @media only screen and (min-width: 600px) {

            /* styles for browsers larger than 960px; */
            .unapprovedUsers {
                font-size: 16px;
            }
        }

        @media only screen and (min-width: 960px) {

            /* styles for browsers larger than 960px; */
            .unapprovedUsers {

                font-size: 18px;
            }
        }

        @media only screen and (min-width: 1920px) {

            /* styles for browsers larger than 1440px; */
            .unapprovedUsers {
                font-size: 20px;
            }
        }

        @media only screen and (min-width: 2560px) {

            /* for sumo sized (mac) screens */
            .unapprovedUsers {
                font-size: 24px;
            }
        }


        .CustomW75 {
            width: 90% !important;
        }

    </style>
    @if(count($unapprovedUsers) ==0)
    <h2 class="text-center">There are no unapproved users right now.</h2>
    @endif
    @foreach ($unapprovedUsers as $user)
        <div class="CustomW75 mx-auto">
            <div class="row">
            <h3 class="mx-auto">Account approval</h3>
                <div class="row mt-3 mb-3 ml-3 mr-3 shadow-lg unapprovedUsers mx-auto col-12 p-3">
                    <div class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                        <div class="justify-content-center align-self-center">
                            <p> Full name: {{ $user->firstname}} {{$user->lastname}}</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                        <div class="justify-content-center align-self-center">
                            <p>Username: {{$user->username}}</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-xl-3 col-lg-4 col-sm-12 col-xxl-3 justify-content-center d-flex">
                        <div class="justify-content-center align-self-center">
                            <p>Email: {{$user->email}}</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-xl-3 col-lg-12 col-sm-12 col-xxl-3 justify-content-center d-flex">
                        <div class="justify-content-center align-self-center">
                            <p>Account Created: {{$user->created_at}}</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-6 col-lg-6 col-sm-12 col-xxl-6 justify-content-center d-flex">
                        <div class="justify-content-center align-self-center">
                            <form action="{{route('approveAccount')}}" method="POST">
                                @csrf
                                <input type='hidden' name='approveID' value='{{$user->id}}'/>
                                <input type='hidden' name='accountType' value='{{$user->accountType}}'/>
                                <input type='submit' value='Approve'>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-6 col-lg-6 col-sm-12 col-xxl-6 justify-content-center d-flex">
                        <div class="justify-content-center align-self-center">
                        <form action="{{route('declineAccount')}}" method="POST">
                                @csrf
                                <input type='hidden' name='declineID' value='{{$user->id}}'/>
                                <input type='hidden' name='accountType' value='{{$user->accountType}}'/>
                                <input type='submit' value='Decline'>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection