@extends('layouts.admin')
@section('title')
    Registrant
@stop
@section('header_files')
    <link rel="stylesheet" href="/css/admin_registrant.css"/>
    <script src="/js/admin_registrant.js"></script>
@stop

@section('content')

        <div class="container-fluid">
            <!--ADD YOUR CODE HERE -->

            @if($reg != null)
            <div class="col-md-4">
                <b>Name</b>
            </div>

            <div class="col-md-6">
                <em>{{$reg->name}}</em>
            </div>

            <div class="col-md-4">
                <b>National ID</b>
            </div>

            <div class="col-md-6">
                <em>{{$reg->ssn}}</em>
            </div>

            <div class="col-md-4">
                <b>Phone Number</b>
            </div>

            <div class="col-md-6">
                <em>{{$reg->phone_number}}</em>
            </div>

            <div class="col-md-4">
                <b>Email</b>
            </div>

            <div class="col-md-6">
                <em> {{$reg->email}}</em>
            </div>

            <div class="col-md-4">
                <b>Courses</b>
            </div>

            <div class="col-md-6">
                <ul>
                    @foreach($reg->courses as $course)
                    <li><em>{{$course->name}}</em></li>
                    @endforeach
                </ul>
            </div>
        </div>

        @else
            <h3>{{"No Results Found!"}}</h3>
            @endif

@stop