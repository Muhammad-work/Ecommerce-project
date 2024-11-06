@extends('layoute.app')
@extends('admin.nav')
@extends('admin.saidebar')



@section('content')
    {{-- <section class="content"> --}}
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 ">
                        <h1 class="m-0 d-inline">General Setting</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">DashBord</a></li>
                            <li class="breadcrumb-item active">General Setting</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="container-fluid ">
            <div class="row ">
                <div class="col-12  ">
                    <div class="card ">
                        <div class="card-header">
                            <p>General Settings information</p>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('store-general-setting',$general->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-10">
                                        <div class="mb-3">
                                            <label for="formFileMultiple" class="form-label">Site Img</label>
                                            <input class="form-control"  onchange="document.querySelector('#input').src = window.URL.createObjectURL(this.files[0])"  type="file" id="formFileMultiple" name="s_img">
                                        </div>
                                        @error('s_img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-2 align-content-center">
                                        <img  style="width: 80%"  id="input" src="{{ asset('storage/' . $general->s_img) }}" alt="">
                                    </div>

                                    <div class="col-12">
                                        <label for="exampleInputEmail1">Site Name</label>
                                        <input type="text" class="form-control" value="{{ $general->s_name }}" name="s_name" id="exampleInputEmail1"
                                            placeholder="Enter Site Name">
                                        @error('s_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label for="exampleInputEmail1">Site Title</label>
                                        <input type="text" class="form-control" value="{{ $general->s_title }}" name="s_title" id="exampleInputEmail1"
                                            placeholder="Enter Site Title">
                                        @error('s_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label for="exampleInputEmail1">Site Copyright</label>
                                        <input type="text" class="form-control" value="{{ $general->s_copyright }}" name="s_copyright" id="exampleInputEmail1"
                                            placeholder="Enter Site Copyright">
                                        @error('s_copyright')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-12 mt-2">
                                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="s_des"
                                            placeholder="Enter Description"> {{ $general->s_des }} </textarea>
                                        @error('s_des')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="card-header mt-4">
                                        <p>Contact Details</p>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label for="exampleInputEmail1">Address</label>
                                        <input type="text" class="form-control" value="{{ $general->s_address }}" name="address" id="exampleInputEmail1"
                                            placeholder="Enter Adress">
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label for="exampleInputEmail1">Phone</label>
                                        <input type="text" class="form-control" value="{{ $general->s_phone }}" name="phone" id="exampleInputEmail1"
                                            placeholder="Enter Phone Number">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="text" class="form-control" value="{{ $general->s_email }}" name="email" id="exampleInputEmail1"
                                            placeholder="Enter Your Email">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
