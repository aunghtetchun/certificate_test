@extends('layouts.apps')

@section('content')
    <div class="row justify-content-start" style="position: fixed">
        <div class="col-12">
            <div class="pb-3">
                <span class="mx-2"><i class="fas fa-angle-right"></i></span>
                <a class="text-uppercase" href="{{ route('post.index') }}">Certificate List</a>
                <span class="mx-2"><i class="fas fa-angle-right"></i></span>
                <span class="text-uppercase">Add Certificate</span>
            </div>
        </div>


        <div class="col-12 col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0 text-uppercase font-weight-bold">
                            <i class="feather-plus-circle text-primary"></i>
                            Add Certificate
                        </h5>
                        <div class="">
                            <a href="{{ route('post.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="feather-list fa-fw"></i>
                            </a>
                        </div>
                    </div>
                    <hr>
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="form-inline d-flex justify-content-center align-items-center">
                                <div class="position-relative">
                                    <button type="button" class="btn btn-light position-absolute edit-photo"
                                            style="bottom: 5px;right: 15px">
                                        <i class="fas fa-upload text-primary"></i>
                                    </button>
                                    <img src="{{ asset("default_user\default.jpg") }}"
                                         style="height: 200px; max-width: 98%;" class="mr-2 rounded current-img" alt="">
                                </div>
                                <input type="file" name="photo" id="file-upload" accept="image/png,image/jpeg" onchange='openFile(event)' class="form-control d-none flex-grow-1 p-1 mr-2">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="title" value="{{old('name')}}" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="nrc">Nrc</label>
                            <input type="text" class="form-control" name="nrc" id="title" value="{{old('nrc')}}" placeholder="Nrc">
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label for="photo">Photo</label>--}}
{{--                            <input type="file" class="form-control" name="photo" id="photo" value="{{old('photo')}}" placeholder="photo">--}}
{{--                        </div>--}}
                        <button type="submit" class="btn btn-primary">Add Certificate</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
{{--    @include('layouts.toast')--}}

@endsection
@section('foot')
    <script>
        $(document).ready(function() {
            $('#outline').summernote();
        });
        $(".edit-photo").click(function () {
            $("#file-upload").click();
        });
        var openFile = function (event) {
            var input = event.target;

            var reader = new FileReader();
            reader.onload = function () {
                var dataURL = reader.result;
                var output = $(".current-img");
                output.attr("src", dataURL);
            };
            reader.readAsDataURL(input.files[0]);
        };
    </script>
@endsection
