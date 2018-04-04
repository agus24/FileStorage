@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            Your Files
                        </div>
                        <div class="col-md-4">
                            @if(Auth::user()->hasRole('superuser'))
                                <a href="javascript:$('#modalUser').modal('show')" class="btn btn-warning">Show Other Files</a>
                            @endif
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="javascript:$('#modalUpload').modal('show')" class="btn btn-primary">Upload</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-responsive">
                        <thead>
                            <th width="5%">No.</th>
                            <th width="">Name</th>
                            <th width="20%">Action</th>
                        </thead>
                        <tbody>
                            @foreach($files as $key => $file)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $file }}</td>
                                    <td><a href="{{ url('download/'.$file) }}" class="btn btn-success">Download</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
