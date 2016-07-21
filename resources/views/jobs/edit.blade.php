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
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn"></i> Update
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <hr>
                        <!--Skills Table-->
                        <!-- <div class="row"> -->
                            <div class="col-md-2 col-md-offset-10">
                                <a href="#" class="btn btn-primary btn-sm" id="addSkillBtn">Add Skill</a>
                            </div>
                            <div class="clearfix"></div> 
                            <table class="table table-striped table-bordered table-hover no-footer"
                                   id="dataTables" role="grid">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Skills</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if ($item->skills)
                                    @foreach($item->skills as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>
                                                <a href="{{route('job.edit', $item->id)}}">
                                                    <span class="glyphicon glyphicon-pencil"></span>
                                                </a>
                                                &nbsp;&nbsp;
                                                <button type="button" class="deleteSkillFromDb" data-id="{{$item->id}}"><span class="glyphicon glyphicon-remove"></span></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        <!-- </div> -->
                        <!--/-->                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup modal to add skill -->
    <div class="modal fade" id="skillAddModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/') }}">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Skills</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="skills" class="col-md-4 control-label">Skill</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control skills" name="skills[]">

                                <span class="help-block">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">                        
                        <button class="btn btn-default" type="submit" id="addNewSkills">Add!</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--/Popup modal -->
    @endsection

            <!--Loading page specific css-->
    @section('page_js')
    @endsection
            <!--/-->

@section('custom_script')
    <script>
        $(document).ready(function () {

            $("#addSkillBtn").on("click", function () {
                $('#skillAddModal').modal('show');
            });            
           
            // Deleting skills from db
            $(".deleteSkillFromDb").on("click", function (evt) {
                var skillId = $(this).data('id');

                //confirm to delete
                if (confirm("Are you sure to delete this skill")) {
                    
                    $.ajax({
                        method: "POST",
                        url: js_base_url + "/jobs/delete-skill",
                        data: {skill_id: skillId}
                    })
                    .done(function (response) {
                        if (response.error == false) {
                            //Remove deleted div
                            $(this).parent('tr').remove();
                        }
                        else {
                            alert(response.message);
                        }
                    });
                }                
            });
        });
    </script>
@endsection


