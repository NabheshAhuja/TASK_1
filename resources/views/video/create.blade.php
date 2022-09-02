@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4> <b>video uploading page</b></h4>
                        <a href="{{ url('video_s') }}" class="btn btn-outline-danger float-end">back</a>
                    </div>
                    <div class="card-body">

                        <form action="{{ url('upload-video') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group-mb-3">
                                <label for="">video name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group-mb-3">
                                <label for="">upload it!</label>
                                <input type="file" name="video" class="mb-2 form-control">
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <br>
                            <div class="form-group-mb-3">
                                <button type="submit" class="btn btn-dark ">Submit!</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
