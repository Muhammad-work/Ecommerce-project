@extends('layoute.index')

@extends('fornt.nav')
@extends('fornt.imgslider')
@extends('fornt.footer')

@section('home')
    <div style="background:#EBCDB5" class="container-fluid">
        <div class="row overflow-hidden">
            <div class="col-12">
                <img style="width: 100%;" class="img-fluid" src="{{ asset('storage/img/b2.jpg') }}" alt="">
            </div>
        </div>
    </div>


    <div class="container mx-auto my-8 px-4">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <!-- Slide Items -->
                <div class="swiper-slide flex justify-center">
                    <a href="https://www.stacker2.com/?srsltid=AfmBOoqZw0BxEcHfk4HShXejOpoaxxS0X45hywW4x-SBkWkzmzEyGTK4">
                        <img src="https://www.stacker2.com/cdn/shop/files/logo_a1a9cc6d-6781-479a-ac5d-1e7623f5a2a1_130x.png?v=1657198844"
                            alt="Logo 1" class="w-32">
                    </a>
                </div>
                <div class="swiper-slide flex justify-center">
                    <a href="https://www.casabella.com/">
                        <img src="https://www.casabella.com/media/logo/stores/1/casabella_300_300.png" alt="Logo 2"
                            class="w-32">
                    </a>
                </div>
                <div class="swiper-slide flex justify-center">
                    <a href="https://www.ocedar.com/">
                        <img src="https://www.ocedar.com/medias/newlogoOCEDAR-copy.png?context=bWFzdGVyfHJvb3R8Mzc5ODl8aW1hZ2UvcG5nfGFETTFMMmd5Wmk4NU1qVTVNVGc1T0RJNU5qWXlMMjVsZDJ4dloyOVBRMFZFUVZJZ1kyOXdlUzV3Ym1jfDk3MzVmYTQxNDM1NWZkYWZhN2QwMjRjM2MxNTM3ZTFlMGEwMzdkMTljMWE5YjI2MmY5NTMyM2E4YmVlYjkzOWI"
                            alt="Logo 2" class="w-32">
                    </a>
                </div>
                <div class="swiper-slide flex justify-center">
                    <a href="https://www.snuggle.com/">
                        <img src="https://dm.henkel-dam.com/is/image/henkel/snuggle_logo_2253x1777?wid=1680&fmt=webp-alpha&qlt=90&fit=vfit"
                            alt="Logo 2" class="w-32">
                    </a>
                </div>
                <div class="swiper-slide flex justify-center">
                    <a href="https://www.naturesblendshop.com/wholesale/">
                        <img src="https://www.naturesblendshop.com/wp-content/uploads/2022/12/NB_50-years-Logo2-002.jpg"
                            alt="Logo 2" class="w-32">
                    </a>
                </div>
                <div class="swiper-slide flex justify-center">
                    <a href="https://foodtolive.com/">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQd6gkK896SATBI04ImtUXOG6IjidhitZfDEg&s"
                            alt="Logo 2" class="w-32">
                    </a>
                </div>

                <!-- Repeat this structure for additional logos -->
            </div>

            <!-- Pagination (dots) and navigation (arrows) -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>






    <div class="w-full h-[100px] flex place-items-center justify-center mt-2 text-[#59595a]">
        <div>
            <h1 class="font-bold text-2xl">BEST SELLS</h1>
        </div>
    </div>



    <div class="flex justify-center flex-wrap md:gap-1 gap-2 mt-2">
        @foreach ($products as $data)
            @if ($data->status > 0)
                <div
                    class="w-[300px] h-auto  ms-3 mt-3 p-1 rounded hover:shadow-lg hover:shadow-indigo-500/40 tradition-all duration-[0.5s] relative cursor-pointer hover:text-black">
                    <a class="text-black hover:text-black" href="{{ route('view-product', $data->id) }}">
                        <div class="w-full h-[220px]">
                            <img class="w-[70%] mx-auto" src="{{ asset('storage/' . $data->p_img) }}" alt="">
                        </div>
                        <div class="text-center">
                            @php
                                $title = substr($data->p_title, 0, 50);
                            @endphp
                            <p class="w-[200px] mx-auto">{{ $title }}</p>
                            <span class=" mt-2 ms-2  inline-block">Price : ${{ $data->p_price }}</span>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach

    </div>



    <div class="w-full h-auto mt-9">
    <img class="w-full" src="{{ asset('storage/img/b-4.png') }}" alt="">
    </div>



    <div class="w-full h-[100px] flex place-items-center justify-center mt-2 text-[#59595a] mt-9">
        <div>
            <h1 class="font-bold text-2xl">Lastest Product</h1>
        </div>
    </div>


    <div class="flex justify-center flex-wrap md:gap-1 gap-2 mt-2">
        @foreach ($products_new as $data)
            @if ($data->status > 0)
                <div
                    class="w-[300px] h-auto  ms-3 mt-3 p-1 rounded hover:shadow-lg hover:shadow-indigo-500/40 tradition-all duration-[0.5s] relative cursor-pointer hover:text-black">
                    <a class="text-black hover:text-black" href="{{ route('view-product', $data->id) }}">
                        <div class="w-full h-[220px]">
                            <img class="w-[60%] mx-auto" src="{{ asset('storage/' . $data->p_img) }}" alt="">
                        </div>
                        <div class="text-center">
                            @php
                                $title = substr($data->p_title, 0, 50);
                            @endphp
                            <p class="w-[200px] mx-auto">{{ $title }}</p>
                            <span class=" mt-2 ms-2  inline-block">Price : ${{ $data->p_price }}</span>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach

    </div>
@endsection
