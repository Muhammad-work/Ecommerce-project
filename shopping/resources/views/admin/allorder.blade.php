@extends('layoute.app')
@extends('admin.nav')
@extends('admin.saidebar')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 d-inline">All Orders</h1>
                    </div><!-- /.col -->

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">DashBord</a></li>
                            <li class="breadcrumb-item active">Orders</li>
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
                                    <th>USER NAME</th>
                                    <th>USER EMAIL</th>
                                    <th>USER PHONE</th>
                                    <th>USER ADDRESS</th>
                                    <th>ORDERS STATUS</th>
                                    <th>VIEW ORDERS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $id =>  $order)
                                    <tr>
                                        <td> {{ $id +1 }} </td>
                                    <td> {{ $order['user']->name }} </td>
                                    <td> {{ $order['user']->email }} </td>
                                    <td> {{ $order['user']->phone }} </td>
                                    <td> {{ $order['user']->address }} </td>
                                    @if ($order->status == 'down')
                                    <td> <span class="p-2 mt-1 d-inline-block text-white bg-success rounded ">Deliver</span> </td>
                                    @endif
                                    <td>
                                        <a href="{{ route('viewallOrders',$order['user']->id) }}" class="btn btn-primary">View</a>
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
