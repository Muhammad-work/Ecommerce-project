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

    <div class="w-full h-[70px] bg-[#F7F7F7] flex items-center px-5">
        <i class="fa-solid fa-bars font-bold  text-2xl cursor-pointer" id="menu"></i>
    </div>

    <div class="md:w-9/12 p-4 mx-auto">
        <h2 class="text-center text-2xl font-semibold">Hello {{ Auth::user()->name }} Welcome to Your Profile</h2>
        <div class="col-12 p-2">
            <div class="bg-white shadow-lg rounded-lg">
                <div class="bg-[#DA9509] text-white rounded-t-lg p-4">
                    <h5 class="mb-0 text-lg">Profile Overview</h5>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <span class="font-bold inline-block mt-3">Name:</span>
                            <span class="font-bold inline-block mt-3"> {{ Auth::user()->name }} </span> <br>
                            <span class="font-bold inline-block mt-3">Phone:</span>
                            <span class="font-bold inline-block mt-3"> {{ Auth::user()->phone }} </span> <br>
                            <span class="font-bold inline-block mt-3">Joined on:</span>
                            <span class="font-bold inline-block mt-3"> {{ Auth::user()->created_at->format('d M, Y') }}
                            </span>
                        </div>
                        <div>
                            <span class="font-bold inline-block mt-3">Email:</span>
                            <span class="font-bold inline-block mt-3"> {{ Auth::user()->email }} </span> <br>
                            <span class="font-bold inline-block mt-3">Address:</span>
                            <span class="font-bold inline-block mt-3"> {{ Auth::user()->address }} </span>
                        </div>
                        <div class="col-12">
                            <a href="{{ route('viewEditPage', Auth::user()->id) }}"
                                class="bg-[#DA9509] text-white px-4 py-2 rounded mt-3 inline-block">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-3">
            <h2 class="text-center text-2xl font-semibold">Today Orders</h2>
            <div class="overflow-x-auto mt-4">
                <table class="min-w-full border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-left">#</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Product Name</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Price</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Quantity</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Total</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Status</th>

                            <th class="border border-gray-300 px-4 py-2 text-left">Action</th>
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
                                    <td class="border border-gray-300 px-4 py-2 flex items-center">
                                        <img style="width: 40px" src="{{ asset('storage/' . $item['img']) }}"
                                            alt="">
                                        <span class="ml-2">{{ $item['name'] }}</span>
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">$ {{ $item['price'] }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $item['quantity'] }}</td>
                                    <td class="border border-gray-300 px-4 py-2">$
                                        {{ $item['price'] * $item['quantity'] }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $order->created_at->format('d M, Y') }}
                                    </td>
                                    @if ($order->status == 'down')
                                        <td><span class="bg-success p-2 text-white rounded">Deliver</span></td>
                                    @else
                                        <td><span class="bg-warning p-2 text-white rounded">Pending</span></td>
                                    @endif
                                    @if ($order->status !== 'down')
                                        <td class="border border-gray-300 px-4 py-2">
                                            <a class="bg-red-500 text-white px-2 py-1 rounded"
                                                href="{{ route('removeOrder', $order->id) }}">Remove</a>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                        @endforeach

                        @if ($orders->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center border border-gray-300 px-4 py-2">No orders for today.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>


    <script>
        let menu = document.getElementById('menu');
        let sidebarmenu = document.getElementById('sidebarmenu');
        let cancenmenu = document.getElementById('cancenmenu');

        menu.addEventListener('click', () => {

            sidebarmenu.style.transform = 'translateX(0%)';


        });
        cancenmenu.addEventListener('click', () => {

            sidebarmenu.style.transform = 'translateX(-100%)';


        });
    </script>
@endsection
