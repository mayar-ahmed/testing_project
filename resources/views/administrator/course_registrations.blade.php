@extends('layouts.admin')
@section('title')
    Course Registrations
@stop
@section('header_files')
    <link rel="stylesheet" href="/css/admin_latest_registrations.css"/>
    <script src="/js/admin_latest_registrations.js"></script>
@stop

@section('content')
        <div class="container-fluid">
            <div class="row">
                @if(Session::has('message'))
                    <div class="alert alert-success">{{Session('message')}}</div>
                @endif
                <div class="table-title">
                    <h3>{{$course->name}}</h3>
                </div>

                @if($registrants->isEmpty())
                    <h2>No Registrations  for this course</h2>
                @else

                <table class="table-bordered table-fill ">
                    <thead>
                    <tr>
                        <th class="text-left">Name</th>
                        <th class="text-left">National ID</th>
                        <th class="text-left">Phone</th>
                        <th class="text-left">Email</th>
                        <th class="text-left">Registration Date</th>
                        <th class="text-left">Confirmed</th>
                        <th class="text-center">Confirm/Delete</th>
                    </tr>
                    </thead>
                    <tbody class="table-hover">
                    @foreach($registrants as $reg)

                        <tr>

                        <td class="text-left">{{$reg->name}}</td>
                        <td class="text-left"> {{$reg->ssn}}</td>
                        <td class="text-left">{{$reg->phone_number}}</td>
                        <td class="text-left">{{$reg->email}}</td>
                        <td class="text-left">{{$reg->pivot->date_time}}</td>
                        <td class="text-center">
                            @if($reg->pivot->confirmed)<span class="glyphicon glyphicon-ok"></span>
                                @else <span class="glyphicon glyphicon-remove"></span>
                                @endif
                        </td>
                        <td class="text-center">
                            <a href="/admin/confirmregistration/{{$course->id}}/{{$reg->ssn}}" class="btn-btn-success"><span class="glyphicon glyphicon-check"></span></a>
                            <a href="/admin/deleteregistration/{{$course->id}}/{{$reg->ssn}}" class="btn-btn-danger"><span class="glyphicon glyphicon-trash"  onclick=" return confirm('Are you sure ?')"></span></a>
                        </td>
                    </tr>

                    @endforeach

                    </tbody>
                </table>
                @endif
            </div>
            <!--ADD YOUR CODE HERE -->


        </div>
@stop