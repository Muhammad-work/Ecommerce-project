@extends('layoute.index')

@extends('fornt.nav')
@extends('fornt.footer')

@section('home')
    <style>
        .image-zoom-container {
            position: relative;
            overflow: hidden;
            /* Hide the overflow */
        }

        .zoom-result {
            position: absolute;
            border: 1px solid #d4d4d4;
            cursor: none;
            width: 300px;
            /* Width of the zoomed area */
            height: 300px;
            /* Height of the zoomed area */
            overflow: hidden;
            z-index: 10;
            display: none;
            /* Hide by default */
        }

        .zoom-result img {
            position: absolute;
            width: auto;
            /* Allow the width to scale */
            height: auto;
            /* Allow the height to scale */
            transform: scale(2);
            /* Adjust the zoom level to your liking */
        }
    </style>
    <!-- Modal Structure -->
    <div id="messageModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-[#CF8D08] text-white">

                    @if (Auth::check())
                        <h5 class="modal-title" id="messageModalLabel">Hello {{ Auth::user()->name }}</h5>
                    @else
                        <h5 class="modal-title" id="messageModalLabel">Message</h5>
                    @endif
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container mx-auto mt-6 px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Product Image -->
            <div class="image-zoom-container relative overflow-hidden">
                <img id="product-image" src="{{ asset('storage/' . $product->p_img) }}" alt="Product Image"
                    class="w-full border border-gray-200 p-4 object-cover">
                <div id="zoom-result" class="zoom-result hidden"></div>
            </div>
            <!-- Product Details -->
            <div>
                <p class="font-semibold text-gray-700">Product Name</p>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $product->p_title }}</h3>

                <div class="mb-4">
                    <span class="font-semibold text-gray-700">Product Category:</span>
                    @foreach ($categoryData as $data)
                        @foreach ($data['sub_category'] as $subCategory)
                            @if ($subCategory->id == $product->sub_category_id)
                                <span class="ml-2 text-gray-800">{{ $subCategory->s_c_name }}</span>
                            @endif
                        @endforeach
                    @endforeach
                </div>

                <div class="mb-4">
                    <span class="font-semibold text-gray-700">Product Brand:</span>
                    @foreach ($brand as $item)
                        @if ($item->id == $product->brand_id)
                            <span class="ml-2 text-gray-800">{{ $item->brand_name }}</span>
                        @endif
                    @endforeach
                </div>

                <div class="mb-4">
                    <span class="font-semibold text-gray-700">Product Price:</span>
                    <span class="ml-2 text-gray-800">${{ $product->p_price }}</span>
                </div>

                <p class="font-semibold text-gray-700 mb-2">Product Description</p>
                <p class="text-gray-600 mb-4">{{ $product->p_des }}</p>

                <div class="flex items-center space-x-4">
                    <a href="#" class=" text-white px-4 py-2 rounded bg-[#CF8D08] hover:bg-[#cf8d08d1] add-to-cart "
                        data-id="{{ $product->id }}">Add To Cart</a>
                    <div class="flex items-center space-x-2">
                        <span class="font-semibold text-gray-700">Quantity:</span>
                        <input type="number" id="qtn" min="1" max="5" value="1"
                            class="w-16 p-2 border border-gray-300 rounded text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container mx-auto mt-7 px-6">
        <div class="border-b border-gray-300 pb-2">
            <h3 class="text-lg font-semibold text-gray-800">Related Product</h3>
        </div>
    </div>


    <div class="container mx-auto mt-7 px-4">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper flex">
                @foreach ($categoryData as $data)
                    @foreach ($data['sub_category'] as $subCategory)
                        @if ($subCategory->id == $product->sub_category_id)
                            @foreach ($products as $productItem)
                                @if ($productItem->sub_category_id == $subCategory->id && $productItem->status > 0)
                                    <div
                                        class="swiper-slide w-[300px] h-auto p-3 rounded shadow-lg hover:shadow-indigo-500/40 transition-all duration-500 relative cursor-pointer text-center">
                                        <a class="text-black hover:text-black"
                                            href="{{ route('view-product', $productItem->id) }}">
                                            <div class="w-full h-[220px] flex items-center justify-center">
                                                <img class="w-[70%]" src="{{ asset('storage/' . $productItem->p_img) }}"
                                                    alt="">
                                            </div>
                                            <div class="mt-2">
                                                @php
                                                    $title = substr($productItem->p_title, 0, 50);
                                                @endphp
                                                <p class="text-lg font-semibold">{{ $title }}</p>
                                                <span class="mt-2 block">Price: ${{ $productItem->p_price }}</span>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endforeach
            </div>
            <!-- Swiper Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <!-- Swiper Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart').click(function(e) {
                e.preventDefault();
                var productId = $(this).data('id');
                let qtn = $('#qtn').val();

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    type: 'POST',
                    data: {
                        product_id: productId,
                        quantity: qtn,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#modalMessage').text(response
                            .message); // Set the message in the modal
                        $('#messageModal').modal('show'); // Show the modal

                        if (response.success) {
                            setTimeout(() => {

                                location.reload();
                            }, 2000);
                        } else {
                            if (response.redirect) {
                                
                                setTimeout(() => {
                                    window.location.href = response.redirect;
                                }, 3000);
                            }
                        }
                    },
                    error: function(xhr) {
                        $('#modalMessage').text(
                            'Something went wrong. Please try again.'); // Set error message
                        $('#messageModal').modal('show'); // Show the modal
                    }
                });
            });
        });

        const productImage = document.getElementById('product-image');
        const zoomResult = document.getElementById('zoom-result');

        productImage.addEventListener('mousemove', (e) => {
            const {
                left,
                top,
                width,
                height
            } = productImage.getBoundingClientRect();
            const x = e.clientX - left;
            const y = e.clientY - top;

            zoomResult.style.left = `${e.pageX + 10}px`; // Position the zoom window slightly away from the mouse
            zoomResult.style.top = `${e.pageY + 10}px`;
            zoomResult.style.display = 'block'; // Show the zoom window

            // Show the image in the zoom window and adjust its position
            zoomResult.innerHTML =
                `<img src="${productImage.src}" style="width: ${width * 2}px; height: ${height * 3}px; transform: translate(-${(x / width) * 100}%, -${(y / height) * 100}%);">`;
        });

        productImage.addEventListener('mouseleave', () => {
            zoomResult.style.display = 'none'; // Hide the zoom window when mouse leaves
        });
    </script>
@endsection
