@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col md-6">
                                <!--Breadcrumb-->
                                <ol class="breadcrumb">
                                    <li><a href="{{url('/')}}">Home</a></li>
                                    <li><a href="{{url('/job')}}">Job</a></li>
                                    <li class="active">View</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <table>
                            <tr>
                                <th>Posted By</th>
                                <td>{{$item->email}}</td>
                            </tr>
                            <tr>
                                <th>Job Title</th>
                                <td>{{$item->title}}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{$item->description}}</td>
                            </tr>
                            <tr>
                                <th>Skills</th>
                                <td>{{$item->skills}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
