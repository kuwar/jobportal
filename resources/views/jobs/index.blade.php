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
                                        <td>{{$item->description}}</td>
                                        <td>
                                            <a href="{{route('job.edit', $item->id)}}">
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
    @if (isset($contacts) && !empty($contacts))
        <script>
            $(document).ready(function () {
                
            });
        </script>
    @endif
@endsection
