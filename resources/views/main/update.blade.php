@extends('Layouts/master')

@section('title', 'Laravel | Update')

@section('content')
    {{-- this is update page {{ $blog->name}} --}}
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <div>
                    <a href="{{ route('list') }}">
                        <input type="button" name="btn-list" value="List Page" class="btn btn-primary shadow-sm rounded my-2" id="">
                    </a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('/blog/formUpdate', $blog->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="oldImage" value="{{ old('image', $blog->image) }}">
                            <div class="text-center">
                                <img src="{{ asset('image/'. $blog->image) }}" style="width:150px; height:150px" alt="">
                            </div>
                            <input type="text" name="name" class="form-control mt-2 @error('name') is-invalid @enderror"
                                placeholder="ブログ名を入力してください..." value="{{ old('name', $blog->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <textarea name="description" id="" class="form-control mt-2 @error('description') is-invalid @enderror"
                                cols="30" rows="8" placeholder="説明を入力してください...">{{ old('description', $blog->description) }}</textarea>
                            @error('description') 
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <input type="file" name="image"
                                class="form-control mt-2 @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <input type="text" name="ownerName" class="form-control mt-2" placeholder="所有者名を入力してください..."
                                value="{{ $blog->owner_name }}">
                            <input type="submit" name="btn-update" class="btn btn-primary text-white shadow-sm mt-2 w-100">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

