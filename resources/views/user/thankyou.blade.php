@extends('layout/app')

@section('body')
	<div class="container-fluid p-0 text-center">
	<h1 class="display-4 my-4">Thank you for your purchase, {{ Auth::user()->first_name . " " . Auth::user()->last_name }}</h1>
	<a href="{{ route("user/history") }}">Click here to see it in your history!</a>
	</div>
@endsection