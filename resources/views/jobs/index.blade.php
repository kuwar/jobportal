@extends('layouts.app')

@section('title')
- List Jobs
@endsection

<!--Page specific css-->
@section('page_css')
    <!-- DataTables CSS -->
    <link href="{{ asset('bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }} " rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('bower_components/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
@endsection
<!--/-->

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
                                    <li class="active">Job</li>
                                </ol>
                            </div>
                            <!--Adding quick link-->
                            <div class="col-md-6 pull-right">
                                <a href="{{ url('/job/create') }}"
                                   class="btn btn-primary btn-sm">Create Job</a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover no-footer"
                               id="dataTables" role="grid">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Posted By</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($items)
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->user->email}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{{str_limit($item->description, 100)}}</td>
                                        <td>
                                            <a href="{{route('job.edit', $item->id)}}" data-id="{{$item->id}}" class="verifyJobLinkId">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </a>
                                            &nbsp;&nbsp;
                                            <a href="{{route('job.show', $item->id)}}">
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                            </a>
                                            &nbsp;&nbsp;
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['job.destroy', $item->id],
                                                'style' => 'display:inline',
                                                'onSubmit' => "return confirm('Do you want to delete?');"
                                                ])
                                            !!}
                                            <button type="submit"><span class="glyphicon glyphicon-remove"></span></button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup modal to verify link id-->
    <div class="modal fade" id="verifyLinkId" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <form class="form-horizontal" id="verifyLinkForm" role="form" method="POST" action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Verify job link</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" >
                            <label for="linkId" class="col-md-3 control-label">Link Id</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="linkId" name="linkId">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">                        
                        <button class="btn btn-default" type="button" id="verifyJobLinkConfirmBtn">Verify</button>
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
    <!-- DataTables JavaScript -->
    <script src="{{ asset('bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
    <!--Custom js-->
    <script src="{{ asset('custom/js/datatable.js') }}"></script>
@endsection
<!--/-->

@section('custom_script')
    <script>
        $(document).ready(function () {
            //disable modal form submit
            $('#verifyLinkForm').submit(false);

            // Modal to input link id
            $(".verifyJobLinkId").on('click', function(evt){
                evt.preventDefault(); 
                var jobId = $(this).data('id');
                var redirectLink = $(this).attr('href');
                // setting values
                $('.modal-body').data('link', redirectLink);
                $('.modal-body').data('jobid', jobId);
                $('#verifyLinkId').modal('show'); 
            });

            // 
            $("#verifyJobLinkConfirmBtn").on('click', function() {
                var redirectLink = $('.modal-body').data('link');
                var jobId = $('.modal-body').data('jobid');
                var linkId = document.getElementById('linkId').value;
                verifyLink(jobId, linkId, redirectLink);                
            });

            // Verify link 
            function verifyLink (jobId, jobLinkId, redirectLink) {
                $.ajax({
                        method: "POST",
                        url: js_base_url + "/job/verify-job-link-id",
                        data: {job_id: jobId, job_link_id: jobLinkId}
                    })
                    .done(function (response) {
                        if (response.error == false) {
                            alert(response.message);
                            window.location.href = redirectLink;
                        }
                        else {
                            alert(response.message);
                            $(".modal-body .form-group").addClass('has-error')
                        }
                    });
            }
        });
    </script>
@endsection
