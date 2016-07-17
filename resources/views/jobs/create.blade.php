@extends('layouts.app')

@section('title')
- Post Job
@endsection

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <!--Breadcrumb-->
                                <ol class="breadcrumb">
                                    <li><a href="{{url('/')}}">Home</a></li>
                                    <li><a href="{{url('/job')}}">Job</a></li>
                                    <li class="active">Create</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('job.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Email<span class="required-indicator">*</span></label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="email"
                                           value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Job Title<span class="required-indicator">*</span></label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title"
                                           value="{{ old('title') }}">

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description<span class="required-indicator">*</span></label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" id="skillsWrapper">
                                <label for="skills" class="col-md-4 control-label">Skills<span class="required-indicator">*</span></label>
                                <div class="singleSkillWrapper">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="skills[]">
                                    </div>
                                    <button type="button" class="col-md-1 addMoreSkill" id="addMoreSkill">
                                        <span class="glyphicon glyphicon-plus">Add</span>
                                    </button>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn"></i> Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_script')
    <script>
        $(document).ready(function () {
            var skillInputToAppend = '<div class="singleSkillWrapper">'+
                                    '<div class="col-md-5 col-md-offset-4">'+
                                    '<input type="text" class="form-control" name="skills[]">'+
                                    '</div>'+
                                    '<button type="button" class="col-md-1 removeSkills">'+
                                    '<span class="glyphicon glyphicon-minus">Remove</span>'+
                                    '</button></div>';

            var skillWrapper = $("#skillsWrapper");

            // Add skills input field
            $("#addMoreSkill").on('click', function (evt) {
                evt.preventDefault();

                $(skillsWrapper).append(skillInputToAppend);
            });

            // Remove skill input field
            $(skillWrapper).on("click",".removeSkills", function(evt){
                evt.preventDefault();

                $(this).parent('div').remove();
            });
        });
    </script>
@endsection
