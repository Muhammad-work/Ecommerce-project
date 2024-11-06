@extends('layoute.app')
@extends('admin.nav')
@extends('admin.saidebar')



@section('content')
    {{-- <section class="content"> --}}
    <div class="content-wrapper">
        <div class="container-fluid ">
            <div class="row ">
                <div class="col-12   mt-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="text-center">Update Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="exampleInputEmail1">Product Title</label>
                                        <input type="text" value="{{ $product->p_title }}" class="form-control"
                                            name="p_title" id="exampleInputEmail1" placeholder="Enter Product Title">
                                        @error('p_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="formFileMultiple" class="form-label">Product Img</label>
                                            <input class="form-control"
                                                onchange="document.querySelector('#input').src = window.URL.createObjectURL(this.files[0])"
                                                type="file" id="formFileMultiple" name="p_img">
                                            <img class="mt-2 " id="input" style="width: 60px"
                                                src="{{ asset('storage/' . $product->p_img) }}" alt="">
                                        </div>
                                        @error('p_img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="formFileMultiple" class="form-label">Product Brand</label>
                                        <select class="form-select" aria-label="Default select example" name="p_brand"
                                            id="formFileMultiple">
                                            @foreach ($brand as $item)
                                                @if ($item->id == $product->brand_id)
                                                    <option selected value=" {{ $product->brand_id }}">
                                                        {{ $item->brand_name }}</option>
                                                @else
                                                    <option value=" {{ $item->id }}">{{ $item->brand_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="formFileMultiple" class="form-label">Product Category</label>
                                        <select class="form-select" aria-label="Default select example" name="p_category"
                                            id="formFileMultiple">
                                            @foreach ($sub_category as $item)
                                                @if ($item->id == $product->sub_category->id)
                                                    <option selected value="{{ $product->sub_category->id }}">
                                                        {{ $item->s_c_name }}</option>
                                                @else
                                                    <option value="{{ $item->id }}">{{ $item->s_c_name }}</option>
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <label for="exampleInputEmail1">Product QTN</label>
                                        <input type="text" value="{{ $product->p_qtn }}" class="form-control"
                                            name="p_qtn" id="exampleInputEmail1" placeholder="Enter Product Qtn">
                                        @error('p_qtn')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mt-2">
                                        <label for="formFileMultiple" class="form-label">Product Status</label>
                                        <select class="form-select" aria-label="Default select example" name="status"
                                            id="formFileMultiple">
                                            @if ($product->status == 0)
                                                <option selected value="0">Unactive</option>
                                            @else
                                                <option selected value=" 1">Active</option>
                                            @endif
                                            <option value="0">Unactive</option>
                                            <option value="1">Active</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <label for="exampleInputEmail1">Product Price</label>
                                        <input type="text" class="form-control" value='{{ $product->p_price }}'
                                            name="p_price" id="exampleInputEmail1" placeholder="Enter Product Price">
                                        @error('p_price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

        

                                    <div class="col-12 mt-2">
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Product
                                                Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="p_des"
                                                placeholder="Enter Product Description">{{ $product->p_des }} </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </section> --}}
@endsection
