@extends('layoute.index')

@extends('fornt.nav')
@extends('fornt.footer')
@extends('fornt.sidebar')

@section('home')
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
    <div class="col-9 mt-4 mx-auto overflow-auto">
        <h2 class="text-center font-bold text-2xl mb-4">All Orders</h2>
        <table class="table table-bordered ">
            <thead class="thead-light">
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $index => $order)
                    @php
                        $cartItems = json_decode($order->cart, true);
                    @endphp

                    @foreach ($cartItems as $item)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>
                                <img style="width: 40px" src="{{ asset('storage/' . $item['img']) }}" alt="">
                            </td>
                            <td>      {{ $item['name'] }}</td>
                            <td>${{ $item['price'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td> ${{ $item['price'] * $item['quantity'] }}</td>
                            <td>{{ $order->created_at->format('d M, Y') }}</td>
                            @if ($order->status == 'down')
                                <td><span class="bg-success p-2 text-white rounded">Deliver</span></td>
                            @else
                                <td><span class="bg-success p-2 text-white rounded">Pending</span></td>
                            @endif
                        </tr>
                    @endforeach
                @endforeach

                @if ($orders->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center">No orders</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
