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
                        <h1 class="m-0 d-inline">All Products</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-2">
                        <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary">Add New</a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">DashBord</a></li>
                            <li class="breadcrumb-item active">Products</li>
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
                                    <th>PRODUCT PRICE</th>
                                    <th>PRODUCT CATEGORY</th>
                                    <th>PRODUCT BRAND</th>
                                    <th>PRODUCT STSTUS</th>
                                    <th>ACTIOLN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productData as $data)
                                    @if ($data['product']->p_qtn > 0)
                                        <tr>
                                            <td>{{ $data['product']->id }}</td>
                                            <td><img style="width: 60px"
                                                    src="{{ asset('storage/' . $data['product']->p_img) }}"
                                                    alt="{{ $data['product']->p_title }}"
                                                    style="width: 100px; height: auto;">
                                            </td>
                                            <td>{{ $data['product']->p_title }}</td>
                                            <td>{{ $data['product']->p_price }}</td>
                                            <td>{{ $data['sub_categories']->s_c_name }}</td>
                                            <td>{{ $data['brand']->brand_name }}</td>
                                            <td>
                                                @if ($data['product']->status == 0)
                                                    <p class='text-white d-inline-block bg-danger p-2 mt-2'>Unactive</p>
                                                @else
                                                    <p class='text-white d-inline bg-primary d-inline-block p-2 mt-2'>Active</p>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('product.edit', $data['product']->id) }}"
                                                    class="btn btn-sm btn-primary" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <form class="d-inline"
                                                    action="{{ route('product.destroy', $data['product']->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
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
