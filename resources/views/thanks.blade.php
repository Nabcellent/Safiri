@extends('layouts.master')
@section('title', 'Thanks')

@section('content')

    <div id="details">
        <nav class="container-fluid my-2" aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thank You</li>
            </ol>
        </nav>

        <div class="container px-xl-5">
            <div class="row px-xl-5 g-md-5">
Thank You
            </div>
        </div>

        <hr>
    </div>

@endsection
