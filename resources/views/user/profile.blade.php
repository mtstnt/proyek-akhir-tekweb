@extends('layout/app')

@section('after-head')
    <style>
        #profile-pic {
			border-radius: 50%;
            margin: 0 auto;
            max-height: 250px;
            max-width: 250px;
        }
    </style>
@endsection

@section('body')
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-center align-items-center mx-auto">
            <div class="col-8 mx-auto" style="border-radius: 50px">
                <div class="row">
                    <div class="col-12 p-4 d-flex justify-content-center flex-column text-light"
                        style="background-color: chocolate; border-radius: 20px">
                        <img id="profile-pic" src="/storage/avatars/{{ Auth::user()->avatar == null ? "default.png" : Auth::user()->avatar }}" alt="Profile Picture">
                        <h3 class="my-2 text-center">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h3>
						<h6 class="my-2 text-center">{{ Auth::user()->email }}</h6>
{{--						<h6 class="my-2 text-center">{{ Auth::user()->carts->get(0)->stock }}</h6> --}}
                        <h6 class="my-2 text-center">Account Level {{ Auth::user()->level }}</h6>
						<h6 class="my-2 text-center">Shopping Points {{ Auth::user()->credit_points }}</h6>
						<div class="row d-flex flex-row justify-content-center">
                            <a href="#" class="col-4 d-inline-block btn btn-dark my-3">Edit Profile</a>
							<a href="#" class="col-4 d-inline-block btn btn-dark my-3">History</a>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
