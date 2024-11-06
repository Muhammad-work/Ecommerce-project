@section('fornt.footer')
    {{-- <div style="background: #F8F8F8" class="container-fluid mt-5 p-4">
        <div class="container">
            <div class="row">
                <div class="col-4  pt-4 ps-5">
                    <h5 class="fw-blod">Ecommerc</h5>
                    <p style="width: 320px">
                        {{ $general->s_des }}
                    </p>
                </div>
                <div class="col-4  pt-4 ps-5">
                    <h5 class="ms-4">Categories</h5>
                    <ul>
                        @foreach ($categoryData as $data)
                            <li class="pt-2"><a href=""
                                    class="text-dark text-decoration-none">{{ $data['category']->category_name }}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="col-4 pt-4 ps-5">
                    <h5 class="ms-4">Contact Us</h5>
                    <ul>
                        <li class="pt-2 me-3"><i class="fa-solid fa-location-dot text-success"></i> Address :
                            {{ $general->s_address }} </li>
                        <li class="pt-2"><i class="fa-solid fa-envelope text-success"></i> Phone : {{ $general->s_phone }}
                        </li>
                        <li class="pt-2"><i class="fa-solid fa-phone text-success"></i> Mobile : {{ $general->s_email }}
                        </li>
                    </ul>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 p-1 ">
                            <p class="mt-4"> {{ $general->s_copyright }} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <footer class="flex flex-wrap justify-between px-10  w-full h-auto bg-[#F7F7F7] md:py-9 py-5 mt-5">
        <div class="mt-3">
            <p class="font-bold text-md">UMA IMPORT INC</p>
            <p class="md:w-[390px] mt-3"> {{ $general->s_des }}</p>
        </div>

        <div class="mt-3">
            <p class="font-bold text-md">Shopping Category</p>
            <ul class="flex flex-col gap-3 mt-3">
                @foreach ($categoryData as $data)
                    <li ><a href="" class="text-black text-decoration-none">{{ $data['category']->category_name }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="mt-3">
            <p class="font-bold text-md">Contact Us</p>
            <ul class="flex flex-col gap-3 mt-3">
                <li>Email : {{ $general->s_email }}</li>
                <li>Phone : {{ $general->s_phone }}</li>
                <li>Address :  {{ $general->s_address }}</li>
            </ul>
        </div>
    </footer>
    <div class="w-full h-[90px] flex place-items-center px-4 bg-[#F7F7F7]">
        <p>{{ $general->s_copyright }}</p>
    </div>
@endsection
