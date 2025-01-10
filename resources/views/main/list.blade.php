@extends('Layouts/master')

@section('title', 'Laravel | Mini Project')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-body">

                    {{-- message from controller using session --}}
                    @if(Session::has('success'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ Session::get('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('form') }}" method="post" enctype="multipart/form-data">
                        @csrf 
                        <input type="text" name="name" class="form-control mt-2 @error ('name') is-invalid @enderror" placeholder="ブログ名を入力してください..." value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <textarea name="description" id="" class="form-control mt-2 @error ('description') is-invalid @enderror" cols="30" rows="8" placeholder="説明を入力してください...">value="{{ old('description') }}"</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <input type="file" name="image" class="form-control mt-2 @error ('image') is-inivalid @enderror" value=" {{ old('image') }} ">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <input type="text" name="ownerName" class="form-control mt-2" placeholder="所有者名を入力してください..." value="">
                        <input type="submit" name="btn-submit" class="btn btn-primary text-white shadow-sm mt-2 w-100">
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            @foreach ($blogs as $item)
                <div class="card mb-2">
                    <div class="card-body d-flex">
                        <div class="col-2">
                            <img src="{{ asset('image/'.$item->image) }}" class="w-100" alt="">
                        </div>
                        <div class="col-8">
                            <div class="ms-2 text-blod">{{ $item->name }}</div>
                            <div class="ms-2 text-muted">{{ $item->description }}</div>
                        </div>
                        <div class="col-1">
                            <button class="btn btn-primary"><i class="fa-solid  fa-pen-to-square"></i></button>
                        </div>
                        <div class="col-1">
                            <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
    
@endsection