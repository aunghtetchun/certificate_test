@extends('layouts.apps')

@section('content')
    <div class="row justify-content-start bg-light vh-100" >
        <div class="col-12" style="position: fixed; z-index: 2">
            <div class="pb-3">
                <span class="mx-2"><i class="fas fa-angle-right"></i></span>
                <a class="text-uppercase" href="{{ route('post.index') }}">Certificate</a>
                <span class="mx-2"><i class="fas fa-angle-right"></i></span>
                <span class="text-uppercase">View Certificate</span>
            </div>
        </div>


        <div class="col-12  bg-light vh-100" >
            <div class=" d-flex justify-content-center pt-4" style="height: 93vh;">
                <img src="{{asset($post->certificate)}}" class="h-100 w-auto" alt="">
                <a href="{{asset($post->certificate)}}" class="btn btn-success ml-5" download="" style="height: 40px;">Download Here</a>
            </div>
            <div>
            </div>
        </div>

    </div>

@endsection
@section('foot')
@endsection

