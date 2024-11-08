@extends('layoute.app')
@extends('admin.nav')
@extends('admin.saidebar')

@section('content')
    @if (session('status'))
        {!! session('status') !!}
    @endif

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-3 ">
                        <h1 class="m-0 d-inline">All Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-2">
                        <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary">Add New</a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">DashBord</a></li>
                            <li class="breadcrumb-item active">Category</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class='container-fluid'>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CATEGORY</th>
                                    <th>ACTIOLN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $value)
                                    <tr>
                                        <td>{{ $value->id}}</td>
                                        <td>{{ $value->category_name }}</td>
                                        <td>
                                            <a href="{{ route('category.edit', $value->id) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <form class="d-inline" action="{{route('category.destroy',$value->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                 <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                </div>

            </div>
        @endsection
