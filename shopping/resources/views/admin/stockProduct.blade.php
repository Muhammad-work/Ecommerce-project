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
                        <h1 class="m-0 d-inline">All Products Stock</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-2">
                        <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary">Add New</a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">DashBord</a></li>
                            <li class="breadcrumb-item active">Products Stock</li>
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
                                    <th>PRODUCT IMG</th>
                                    <th>PRODUCT TITLE</th>
                                    <th>PRODUCT STOCK</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $data)
                                    @if ($data->p_qtn > 0)
                                        <tr>
                                            <td> {{ $data->id }} </td>
                                            <td>
                                                <img style="width: 60px" src="{{ asset('storage/' . $data->p_img) }}"
                                                    alt="">
                                            </td>
                                            <td> {{ $data->p_title }} </td>
                                            <td> {{ $data->p_qtn }} </td>

                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                </div>
            </div>
        @endsection
