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


        <div class="col-12 ">
            <table class="table table-hover table-bordered table-responsive-xl mb-0">
                <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Nrc</th>
                    <th>Control</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                </tr>
                </thead>
                <tbody>

                @foreach($posts as $p)

                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>
                            <div class="d-flex align-items-center ">
                                <div class="list-preview mr-2 no-warp" style="background-image: url('{{ asset("user_thumbnail/".$p->photo) }}')"></div>
                                <span class="nowrap">{{ $p->name }}</span>
                            </div>
                        </td>
                        <td>{{ $p->nrc }}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button id="dLabel" type="button" class="btn btn-outline-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather-menu mb-0"></i>
                                </button>
                                <div class="dropdown-menu p-2" aria-labelledby="dLabel">
                                    <a href="{{ route('post.show',$p->id) }}"  class="btn btn-sm btn-outline-success text-left mb-2 w-100 d-block">
                                        <i class="feather-link"></i> View
                                    </a>
                                    <a href="{{ route('post.edit',$p->id) }}" class="btn btn-sm btn-outline-info text-left mb-2 w-100 d-block">
                                        <i class="feather-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('post.destroy',$p->id) }}" class="d-block" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <button href="" class="btn btn-sm btn-outline-danger text-left w-100">
                                            <i class="feather-trash-2"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td class="no-warp">
                            {{ $p->created_at->format("j.n.y") }}
                        </td>
                        <td class="no-warp">
                            {{ $p->created_at->format("h:i") }}
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>

    </div>
    @include('layouts.toast')

@endsection
@section('foot')
@endsection

