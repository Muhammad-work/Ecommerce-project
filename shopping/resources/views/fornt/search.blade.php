@extends('layoute.index')
@extends('fornt.nav')
@extends('fornt.footer')

@section('home')
    <div class="bg-gray-100 container-fluid">
        <div class="row text-center mt-4 p-5">
            <div class="col-12">
                @if ($keyword)
                    <h1 class="font-bold text-3xl">Search: {{ $keyword }}</h1>
                @endif

                <span><a href="{{ route('home') }}" class="no-underline text-gray-800">Home / </a></span>

                @php
                    $subCategoryIds = $products->pluck('sub_category_id')->unique();
                @endphp
                @foreach ($categoryData as $data)
                    @if ($subCategoryIds->contains($data['category']->id))
                        <span class="text-[#E2990F]">{{ $data['category']->category_name }}</span>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex justify-center gap-6 md:flex-row flex-col">
        <div class="md:w-[100%] w-full h-auto">
            <div class="flex justify-center flex-wrap md:gap-1 gap-2 mt-2">
                {{-- Display message if no products are found --}}
                @if ($products->isEmpty())
                    <p>No products found for the keyword "{{ $keyword }}".</p>
                @else
                    {{-- Loop through each product and display it --}}
                    @foreach ($products as $data)
                        @if ($data->status > 0)
                            <div
                                class="w-[300px] h-auto ms-3 mt-3 p-1 rounded hover:shadow-lg hover:shadow-indigo-500/40 transition-all duration-[0.5s] relative cursor-pointer hover:text-black">
                                <a class="text-black hover:text-black" href="{{ route('view-product', $data->id) }}">
                                    <div class="w-full h-[220px]">
                                        <img class="w-[70%] mx-auto" src="{{ asset('storage/' . $data->p_img) }}"
                                            alt="">
                                    </div>
                                    <div class="text-center">
                                        @php
                                            $title = substr($data->p_title, 0, 50);
                                        @endphp
                                        <p class="w-[200px] mx-auto">{{ $title }}</p>
                                        <span class="mt-2 ms-2 inline-block">Price: ${{ $data->p_price }}</span>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <script>
        let uparrow = document.querySelector('#uparrow');
        let downarrow = document.querySelector('#downarrow');
        let menu = document.querySelector('#menu');

        uparrow.addEventListener('click', () => {
            menu.style.display = 'none';
            downarrow.style.display = 'block';
            uparrow.style.display = 'none';
        });

        downarrow.addEventListener('click', () => {
            menu.style.display = '';
            downarrow.style.display = 'none';
            uparrow.style.display = '';
        });
    </script>
@endsection
