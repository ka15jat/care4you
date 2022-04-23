@extends('layouts.mainCentered')

@section('Content')

    <style>
        @media only screen and (max-width: 600px) {
            .w-25{
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 1300px) {
            .w-25{
                width: 75% !important;
            }
        }
    </style>

    <form class='w-25 mx-auto' id='registerForm' method="POST" action='{{ route('RegisterPOST') }}'>
        @csrf
        <h2 style="font-size:76px;margin-bottom:50px;">Care 4 You</h2>

        <!-- name  input -->
        <div class="form-outline mb-4 class='mx-auto'">
            <label class="form-label" for="usernameinput">First Name</label>
            <input type="text" id="firstnameinput" name="firstname" class="form-control" required />
        </div>

        <div class="form-outline mb-4 class='mx-auto'">
            <label class="form-label" for="usernameinput">Last Name</label>
            <input type="text" id="lastnameinput" name="lastname" class="form-control" required />
        </div>

        <!-- Username input -->
        <div class="form-outline mb-4 class='mx-auto'">
            <label class="form-label" for="usernameinput">Username</label>
            <input type="textsett" id="usernameinput" name="username" class="form-control" required />
        </div>

        <div class="form-outline mb-4 class='mx-auto'">
            <label class="form-label" for="emailinput">Email address</label>
            <input type="email" id="emailinput" name="email" class="form-control" required />
        </div>

        <!-- Create Password input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="passinput">Password</label>
            <input type="password" id="passinput" name="password" class="form-control" required />
        </div>

        <!-- confirm Password input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="confirmpassinput">Confirm Password</label>
            <input type="password" id="confirmpassinput" name="cpassword" class="form-control" required />
        </div>
        <!-- dropdown input -->
        <select class="form-select mb-2" aria-label="dropdownMenuButton" id="dropdownMenuButton">
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <option selected>Select User type</option>
            <option class="dropdown-item">Admin</option>
            <option class="dropdown-item">Owner</option>
            <option class="dropdown-item">Staff</option>
        </select>

        <!-- confirm company code input -->
        <div class="form-outline mb-4" style='display:none;' id='companyCodeDiv'>
            <label class="form-label" for="companycodeinput">Confirm company code</label>
            <input type="text" id="companycodeinput" name='companyCode' class="form-control" />
        </div>

        <!-- Submit button -->
        <input type="submit" class="btn btn-primary btn-block mb-4 mx-auto" style="width:50%;" value='Register'>

        <!-- Sign buttons -->
        <div class="text-center">
            <p>Got an account? <a href="{{ route('login') }}">Sign in</a></p>
        </div>
    </form>

    <script>
        (function() {

            document.querySelector('#dropdownMenuButton').addEventListener('change', handleDropdownClick)

            function handleDropdownClick(e){
                console.log('hello')
                let accountType = e.currentTarget.value;
                console.log(accountType)
                if (accountType == 'Staff') {
                    document.querySelector('#companyCodeDiv').style.display = 'block';
                } else {
                    document.querySelector('#companyCodeDiv').style.display = 'none';
                }
                console.log(document.querySelector("#dropdownMenuButton"))
                document.querySelector("#dropdownMenuButton > option:checked").innerHTML = accountType;
                if(document.querySelector('#registerForm > .accountType') != null){
                    document.querySelector('#registerForm > .accountType').remove();
                }

                let child = document.createElement('input');
                child.type = 'hidden'
                child.name = 'accountType'
                child.className = 'accountType'
                child.value = accountType 
                console.log(child)
                console.log(document.querySelector('#registerForm'))
                document.querySelector('#registerForm').append(child)
            }
            

            document.querySelector("#registerForm").addEventListener('submit', function(e) {
                console.log('hello')
                if (document.querySelector("#registerForm > .accountType").length == 0) {
                    alert('You need to choose an account type.');
                    e.preventDefault()
                }
            })


        })();
    </script>
@endsection
