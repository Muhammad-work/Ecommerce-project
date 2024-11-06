@extends('layoute.index')

@extends('fornt.nav')
@extends('fornt.footer')

@section('home')
    <div class="bg-gray-100">
        <div class="container mx-auto text-center py-10">
            <h1 class="text-3xl font-bold ">My Cart</h1>
            <div class="mt-2 text-gray-600">
                <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Home</a> / <span class="text-[#CF8D08]">My
                    Cart</span>
            </div>
        </div>

   
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col lg:flex-row space-y-6 lg:space-y-0 lg:space-x-6">
                <!-- Cart Table Section -->
                <div class="w-full lg:w-2/3 bg-white border rounded-lg shadow-lg overflow-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-4 px-6 text-left text-sm font-semibold">Product</th>
                                <th class="py-4 px-6 text-left text-sm font-semibold"></th>
                                <th class="py-4 px-6 text-left text-sm font-semibold">Price</th>
                                <th class="py-4 px-6 text-left text-sm font-semibold">Quantity</th>
                                <th class="py-4 px-6 text-left text-sm font-semibold">Total</th>
                                <th class="py-4 px-6 text-left text-sm font-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (session('cart') && count(session('cart')) > 0)
                                @foreach (session('cart') as $id => $product)
                                    <tr class="border-b">
                                        <td class="py-4 px-6 flex items-center space-x-4">
                                            <img class="w-16 h-16 object-cover rounded"
                                                src="{{ asset('storage/' . $product['img']) }}" alt="Product Image">

                                        </td>
                                        <td>
                                            @php
                                                $title = substr($product['name'], 0, 20);
                                            @endphp
                                            <p class="text-sm font-medium">{{ $title }}....</p>
                                        </td>
                                        <td class="py-4 px-6 text-sm">${{ $product['price'] }}</td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center">
                                                <button class="border rounded px-3 py-1 text-gray-700 hover:bg-gray-200"
                                                    onclick="updateQuantity('{{ $id }}', 'decrease')">-</button>
                                                <span class="mx-3 text-sm">{{ (int) $product['quantity'] }}</span>
                                                <button class="border rounded px-3 py-1 text-gray-700 hover:bg-gray-200"
                                                    onclick="updateQuantity('{{ $id }}', 'increase')">+</button>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 text-sm">$
                                            {{ (int) $product['price'] * (int) $product['quantity'] }}</td>
                                        <td class="py-4 px-6">
                                            <button class="text-red-500 hover:text-red-700 text-sm"
                                                onclick="removeFromCart('{{ $id }}')">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center py-6 text-sm">Your cart is empty.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Order Summary Section -->
                @if (session('cart') && count(session('cart')) > 0)
                    <div class="w-full lg:w-1/3 bg-white border rounded-lg p-6 shadow-lg">
                        <h5 class="text-lg font-semibold border-b pb-4">Order Summary</h5>
                        <div class="mt-4 flex justify-between">
                            <span>Sub Total</span>
                            @php
                                $subtotal = 0;
                                if (session('cart')) {
                                    foreach (session('cart') as $product) {
                                        $subtotal += $product['price'] * $product['quantity'];
                                    }
                                }
                            @endphp
                            <span>${{ $subtotal }}</span>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <div class="mt-4 pt-4 border-t flex justify-between font-semibold">
                            <span>Total</span>
                            <span>${{ $subtotal }}</span>
                        </div>
                                        
                    <a href="" class="mt-2 w-full block text-center bg-[#E2990F] hover:[#E2990F] text-white py-2 rounded-lg text-sm font-medium order"
                    onclick="submitOrder('{{ $subtotal }}')">Check Out</a>
                     
                        <a href="{{ route('home') }}"
                            class="mt-2 w-full block text-center bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg text-sm font-medium">Continue
                            Shopping</a>
                    </div>
                @endif
            </div>
        </div>



        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function submitOrder(total) {
                $.ajax({
                    url: "{{ route('order.store') }}",
                    type: 'POST',
                    data: {
                        total: total,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Something went wrong. Please try again.');
                    }
                });

            }

            function updateQuantity(productId, action) {
                $.ajax({
                    url: "{{ route('cart.update') }}",
                    type: 'POST',
                    data: {
                        product_id: productId,
                        action: action,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {

                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Something went wrong. Please try again.');
                    }
                });
            }

            function removeFromCart(productId) {
                $.ajax({
                    url: "{{ route('cart.remove') }}",
                    type: 'POST',
                    data: {
                        product_id: productId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {

                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Something went wrong. Please try again.');
                    }
                });
            }

            // function isLoggedIn() {
            //     // Replace with actual logic to check login status
            //     // For example, you might check a session variable or token
            //     return {{ auth()->check() ? 'true' : 'false' }};
            // }

            // // Function to handle order placement
            // function submitOrder(subtotal) {
            //     if (!isLoggedIn()) {
            //         // Redirect to login if the user is not logged in
            //         window.location.href = "{{ route('login') }}";
            //     } else {
            //         // Show the order confirmation modal
            //         openModal();
            //     }
            // }

            // // Function to open the modal
            // function openModal() {
            //     document.getElementById('orderConfirmationModal').classList.remove('hidden');
            // }

            // // Function to close the modal
            // function closeModal() {
            //     document.getElementById('orderConfirmationModal').classList.add('hidden');
            // }
        </script>
    @endsection
