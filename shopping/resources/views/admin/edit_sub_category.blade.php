@extends('layoute.app') <!-- Assuming 'layout.app' is the main layout file -->

@extends('admin.nav') <!-- Include navigation -->
@extends('admin.saidebar') <!-- Include sidebar -->

@section('content')
    <section class="content">
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 b-block m-auto mt-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="text-center">Add New Sub Category</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('sub-category.update',$data->sub_id) }}" method="POST" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="sub_category_name">Sub Category Name</label>
                                        <input type="text" name="sub_category_name" value="{{ $data->s_c_name }}"
                                            class="form-control" id="sub_category_name"
                                            placeholder="Enter sub category name">
                                        @error('sub_category_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id">Category</label>
                                        <select name="category_id" class="form-select" id="category_id"
                                            aria-label="Default select example">
                                            @foreach ($categories as $category)
                                                @if ($category->id == $data->category_id)
                                                    <option value="{{ $data->category_id }}" selected>
                                                        {{ $category->category_name }}</option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
    </section>
@endsection
