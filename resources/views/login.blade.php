@extends('layouts.mainCentered')

@section("Content")

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

<form class='w-25 mx-auto' method="POST" action="{{route('LoginPOST')}}">
    @csrf
    <h2 style="font-size:76px;margin-bottom:50px;" >Care 4 You</h2>
  <!-- Email input -->
  <div class="form-outline mb-4 class='mx-auto'">
    <label class="form-label" for="usernameinput">Username</label>
    <input type="username" id="usernameinput" name='username' class="form-control" />
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="passinput">Password</label>
    <input type="password" id="passinput" name='password' class="form-control" />
  </div>



  <!-- Submit button -->
  <button type="submit" class="btn btn-primary btn-block mb-4 mx-auto" style="width:50%;">Sign in</button>

  <!-- Register buttons -->
  <div class="text-center">
    <p>Not a user? <a href="{{route('register')}}">Register</a></p>
  </div>
</form>
@endsection