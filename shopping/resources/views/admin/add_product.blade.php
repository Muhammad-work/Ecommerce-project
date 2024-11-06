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
                            <h3 class="text-center">Add New Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="exampleInputEmail1">Product Title</label>
                                        <input type="text" class="form-control" name="p_title" id="exampleInputEmail1"
                                            placeholder="Enter Product Title">
                                        @error('p_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="formFileMultiple" class="form-label">Product Img</label>
                                            <input class="form-control" type="file" id="formFileMultiple" name="p_img">
                                        </div>
                                        @error('p_img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="formFileMultiple" class="form-label">Product Brand</label>
                                        <select class="form-select" aria-label="Default select example" name="p_brand"
                                            id="formFileMultiple">
                                            <option selected>-- Select Brand --</option>
                                            @foreach ($brand as $item)
                                                <option value="{{ $item->id }}">{{ $item->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="formFileMultiple" class="form-label">Product Category</label>
                                        <select class="form-select" aria-label="Default select example" name="p_category"
                                            id="formFileMultiple">
                                            <option selected>-- Select Category --</option>
                                            @foreach ($sub_category as $s_item)
                                                <option value="{{ $s_item->id }}">{{ $s_item->s_c_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <label for="exampleInputEmail1">Product QTN</label>
                                        <input type="text" class="form-control" name="p_qtn" id="exampleInputEmail1"
                                            placeholder="Enter Product Qtn">
                                        @error('p_qtn')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mt-2">
                                        <label for="formFileMultiple" class="form-label">Product Status</label>
                                        <select class="form-select" aria-label="Default select example" name="status"
                                            id="formFileMultiple">
                                            <option selected>-- Select Status --</option>
                                            <option value="1">Active</option>
                                            <option value="0">Unactive</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label for="exampleInputEmail1">Product Price</label>
                                        <input type="text" class="form-control" name="p_price" id="exampleInputEmail1"
                                            placeholder="Enter Product Price">
                                        @error('p_price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                        

                                    <div class="col-12 mt-2">
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Product
                                                Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="p_des"
                                                placeholder="Enter Product Description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </section> --}}
@endsection
