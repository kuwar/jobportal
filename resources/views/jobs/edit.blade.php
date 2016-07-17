@extends('layouts.app')

@section('title')
- Edit Job
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
                                    <li class="active">Edit</li>
                                </ol>
                            </div>
                            <!--Adding quick link-->
                            <div class="col-md-6 pull-right">
                                <a href="{{url('/job')}}" class="btn btn-success btn-sm">List Jobs</a>
                                &nbsp;
                                <a href="{{ url('/job/create') }}"
                                   class="btn btn-primary btn-sm">Create Job</a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        {!! Form::model($item, [ 'method' => 'PATCH', 'route' => ['job.update', $item->id], 'role' => 'form', 'class' => 'form-horizontal' ] ) !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::label('email', 'Email*', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
                                {!! Form::text('user[email]', old('email'), ['class' => 'form-control', 'id' => 'email']) !!}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            {!! Form::label('title', 'Job Title*', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
                                {!! Form::text('title', old('title'), ['class' => 'form-control', 'id' => 'title']) !!}

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            {!! Form::label('description', 'Description*', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
                                {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'id' => 'description']) !!}

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group{{ $errors->has('skills') ? ' has-error' : '' }}">
                            {!! Form::label('skills', 'Skills*', array('class' => 'col-md-4 control-label')) !!}

                            <div class="col-md-6">
                                {!! Form::text('skills', old('skills'), ['class' => 'form-control', 'id' => 'skills']) !!}

                                @if ($errors->has('skills'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('skills') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!--displaying old skills-->
                            @if ($item->skills)
                                @foreach ($item->skills as $skill)
                                    <div class="col-md-6 col-md-offset-4">
                                        {!! Form::text('skills', old('skills'), ['class' => 'form-control', 'id' => 'skills']) !!}

                                        @if ($errors->has('skills'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('skills') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                            <!--/-->
                            
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn"></i> Update
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

            <!--Loading page specific css-->
    @section('page_js')
    @endsection
            <!--/-->

@section('custom_script')
    <script>
        $(document).ready(function () {
            
        });
    </script>
@endsection
