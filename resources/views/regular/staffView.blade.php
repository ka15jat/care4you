@extends('layouts.mainCentered')

@section('Content')
    @if (Auth::Guard('Owner')->check())
        <p>Company Code:{{ Auth::Guard('Owner')->user()->companyCode }} </p>
    @endif
    <form class='row' method='POST' action='{{route('handleRota')}}' enctype="multipart/form-data">
        @if (Auth::Guard('Owner')->check())
        @csrf
            <div class="mb-3 col-md-3">
                <label class="form-label" for="rotaimage">Rota image Upload</label>
                <input type="file" class="form-control" name="rotaimage" id="rotaimage" required />
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </div>
        @endif

        <div class="mb-3 col-md-9 mx-auto">
            <img src='https://care4you.s3.eu-west-2.amazonaws.com/{{$path}}' class='mx-auto' alt='Rota Image'
                style='width: 98%; min-height:96%;' />
        </div>
    </form>
@endsection
