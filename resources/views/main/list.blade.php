@extends('Layouts/master')

@section('title', 'Laravel | Mini Project')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-body">

                        {{-- message from controller using session --}}
                        {{-- @if (Session::has('success'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ Session::get('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif --}}

                        <form action="{{ route('formCreate') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="name" class="form-control mt-2 @error('name') is-invalid @enderror"
                                placeholder="ブログ名を入力してください..." value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <textarea name="description" id="" class="form-control mt-2 @error('description') is-invalid @enderror"
                                cols="30" rows="8" placeholder="説明を入力してください...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <input type="file" name="image"
                                class="form-control mt-2 @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <input type="text" name="ownerName" class="form-control mt-2" placeholder="所有者名を入力してください..."
                                value="">
                            <input type="submit" name="btn-submit" class="btn btn-primary text-white shadow-sm mt-2 w-100">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <form action="{{ route('list') }}" method="get">
                    @csrf
                    <div class="col-6 offset-6 mb-2">
                        <div class="input-group">
                            <input type="text" name="searchKey" class="form-control" value="{{ request('searchKey') }}" placeholder="Enter Search Key..." aria-label="Input group example" aria-describedby="btnGroupAddon2">
                            <button type="submit" class="btn btn-primary input-group-text"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </form>


                @if(count($blogs) != 0)
                    @foreach ($blogs as $item)

                        <div class="card mb-2">
                            <div class="card-body d-flex">
                                <div class="col-2">
                                    <img src="{{ asset('image/' . $item->image) }}" class="w-100" alt="">
                                </div>
                                <div class="col-8">
                                    <div class="ms-2 text-blod">{{ $item->name }}</div>
                                    <div class="ms-2 text-muted">{{ $item->description }}</div>
                                </div>
                                <div class="col-1">
                                    <a href="{{ url('blog/update/'. $item->id) }}">
                                        <button class="btn btn-primary"><i class="fa-solid  fa-pen-to-square"></i></button>
                                    </a>
                                </div>
                                <div class="col-1">
                                    <button type="button" onclick="confirmDelete({{ $item->id }})"
                                        class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h3 class="text-center my-3 text-muted">No record found!</h3>
                @endif

                <span>{{ $blogs->links() }}</span>
            </div>
        </div>

    </div>
@endsection

@section('js-script')
    <script>
        function confirmDelete($id) {
            // console.log($id);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                    setInterval(() => {
                        location.href = "/blog/delete/" + $id
                    }, 1000);
                }
            });
        }
    </script>

@endsection
