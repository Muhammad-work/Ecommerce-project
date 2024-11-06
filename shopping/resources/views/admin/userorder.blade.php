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
                    <div class="col-sm-6 ">
                        <h1 class="m-0 d-inline">All Order</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">DashBord</a></li>
                            <li class="breadcrumb-item active">Order</li>
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
                                    <th>ORDER IMG</th>
                                    <th>ORDER TITLE</th>
                                    <th>ORDER TOTAL PRICE</th>
                                    <th>ORDER QUENTITY</th>
                                    <th>ORDER DATE</th>
                                    <th>ORDER STSTUS</th>
                                    <th>ACTIOLN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $index => $order)
                                    @php
                                        $cartItems = json_decode($order->cart, true);
                                    @endphp

                                    @foreach ($cartItems as $item)
                                        <tr class="hover:bg-gray-50">
                                            <th class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</th>
                                             <td> <img style="width: 60px"
                                                src="{{ asset('storage/' . $item['img']) }}"
                                                alt=""
                                                style="width: 100px; height: auto;"> </td>
                                             <td> {{ $item['name'] }} </td>
                                             <td>${{ $item['price'] * $item['quantity'] }}</td>
                                             <td> {{ $item['quantity'] }} </td>
                                             <td>{{ $order->created_at->format('d M, Y') }}</td>
                                             <td> <span  class="bg-warning p-2 mt-1 d-inline-block text-white rounded"> {{ $order->status }}</span></td>
                                             <td>
                                              <a href="{{ route('deliverOrder',$order->id) }}" class="bg-success btn btn-sm p-2 mt-1 d-inline-block text-white rounded">Deliver</a>
                                              <a href="{{ route('cancelrOrder',$order->id) }}" class="bg-danger btn btn-sm p-2 mt-1 d-inline-block text-white rounded">Cancel</a>
                                             </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                </div>
            </div>
        @endsection
