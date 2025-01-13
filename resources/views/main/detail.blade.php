@extends('Layouts/master')

@section('title', 'Laravel | detail')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-7 offset-3">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('blog/detail/') . $detail->id }}" method='POST' enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-3">
                                    <div class="alert alert-primary" role="alert">
                                        Name
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="alert alert-primary" role="alert">
                                        {{ $detail->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="alert alert-primary" role="alert">
                                        Description
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="alert alert-primary" role="alert">
                                        {{ $detail->description }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="alert alert-primary" role="alert">
                                        Image
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="alert alert-primary" role="alert">
                                        <img src="{{ asset('image/' . $detail->image) }}"
                                            style="width: 150px; height:150px;" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="alert alert-primary" role="alert">
                                        Owner Name
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="alert alert-primary" role="alert">
                                        {{ $detail->owner_name }}
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('list') }}">
                                <input type="button" value="List Page" class="btn btn-primary shadow-sm w-100">
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
