@extends('Layouts/master')

@section('title', 'Laravel | Mini Project')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <input type="text" name="name" class="form-control mt-2" placeholder="Enter Blog name..." value="">
                        <input type="text" name="title"class="form-control mt-2" placeholder="Enter Title name..." value="">
                        <textarea name="description" id="" class="form-control mt-2" cols="30" rows="8" placeholder="Enter Description..."></textarea>
                        <input type="file" name="image" class="form-control mt-2" value="">
                        <input type="text" name="owner-name" class="form-control mt-2" placeholder="Enter owner name..." value="">
                        <input type="submit" name="btn-submit" class="btn btn-primary text-white shadow-sm mt-2 w-100">
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body d-flex">
                    <div class="col-10">
                        Testing
                    </div>
                    <div class="col-1">
                        <button><i class="fa-solid text-primary fa-pen-to-square"></i></button>
                    </div>
                    <div class="col-1">
                        <button><i class="fa-solid text-danger fa-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
    
@endsection