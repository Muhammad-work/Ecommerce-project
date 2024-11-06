


@section('fornt.nav')


    <nav class="flex justify-between items-center w-full h-[90px] bg-[#F7F7F7] md:px-4 px-3">
        <!-- Logo Section -->
        <div>
            <a href="{{ route('home') }}">
                <img class="md:w-[190px] w-[150px]" src="{{ asset('storage/' . $general->s_img) }}" alt="">
            </a>
        </div>

        <!-- Search Section -->
        <div class="flex bg-white justify-between py-2 px-3 rounded place-items-center md:block hidden">
            <form action="{{ route('search') }}" method="get" autocomplete="off">
                @csrf
                <div class="flex items-center">
                    <!-- Search Input -->
                    <input id="keyword" class="w-full py-2 outline-none px-1" type="text" name="keyword"
                        placeholder="Search Here ...">
                    <input class="w-full py-2 outline-none px-1 category" type="hidden" name="category"
                        placeholder="Search Here ...">

                    <!-- Category Dropdown -->
                    <select class="form-select p-0 w-[340px] py-2 px-1 border-none" id="selectbox"
                        aria-label="Default select example">
                        <option selected>SELECT CATEGORIES</option>
                        @foreach ($categoryData as $item)
                            @foreach ($item['sub_category'] as $data)
                                <option value="{{ $data->id }}">{{ $data->s_c_name }}</option>
                            @endforeach
                        @endforeach
                    </select>

                    <!-- Search Button -->
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>

        <!-- User Profile and Cart Section -->
        <div class="flex md:gap-4 gap-1">
            <div class="flex items-center md:gap-3 gap-3">
                <i class="fa-solid fa-magnifying-glass font-bold text-xl cursor-pointer md:hidden " id="search"></i>

                @if (!Auth::check())
                    <a href="{{ route('login') }}" aria-label="User Profile">
                        <i class="fa-solid fa-user font-bold text-xl cursor-pointer"></i>
                    </a>
                @endif

                <div class="relative me-3">
                    <a href="{{ route('mycart') }}" aria-label="Shopping Cart">
                        <i class="fa-solid fa-cart-shopping font-bold text-xl cursor-pointer"></i>
                    </a>
                    <span
                        class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-semibold rounded-full w-5 h-5 flex items-center justify-center">
                        {{ session('cart') ? count(session('cart')) : 0 }}
                    </span>
                </div>
            </div>

            @if (Auth::check())
                <!-- User Dropdown for Logged-in Users -->
                <div class="dropdown p-0">
                    <button class="btn btn-secondary dropdown-toggle bg-[#D28F0B] hover:bg-[#cf8d08d1]" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('viewProfile') }}">My Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('viewAllOrders') }}">My Orders</a></li>
                        <li>
                            <a class="dropdown-item" href=""
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </nav>

    <header class="flex justify-between w-full h-[80px] place-items-center px-3">
        <div class="flex place-items-center gap-3 w-full h-auto ">
            <div class="dropdown ">
                <button class="btn btn-secondary dropdown-toggle md:py-3 py-2 bg-[#CF8D08] hover:bg-[#cf8d08d1]"
                    type="button" data-bs-toggle="dropdown">
                    SHOPPING CATEGORIES
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @foreach ($categoryData as $data)
                        <li class="dropdown-header">
                            <a href="#"
                                class="text-dark text-decoration-none">{{ $data['category']->category_name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <ul class="flex gap-3">
                <li class="cursor-pointer font-blod "><a href="{{ route('home') }}" class="hover:text-black">HOME</a></li>
                <li class="cursor-pointer font-blod "><a href="{{ route('about') }}" class="hover:text-black">ABOUT </a>
                </li>
            </ul>
        </div>
        <div class="w-full h-[90px] bg-gray-300 fixed top-0 left-0 z-30 md:px-4 px-3 hidden" id="searchbox">
            <div class="flex bg-white w-[100%] justify-between py-2 px-3 rounded place-items-center md:block  mx-auto mt-3">
                <form action="{{ route('search') }}" method="get" autocomplete="off">
                    @csrf
                    <div class="flex items-center">
                        <!-- Search Input -->
                        <input id="keyword" class="w-full py-2 outline-none px-1" type="text" name="keyword"
                            placeholder="Search Here ...">
                        <input  class="w-full py-2 outline-none px-1  category" type="hidden" name="category"
                            placeholder="Search Here ...">
        
                        <!-- Category Dropdown -->
                        <select class="form-select p-0 w-auto py-2 px-1 border-none" id="selectbox"
                            aria-label="Default select example">
                            <option selected>SELECT CATEGORIES</option>
                            @foreach ($categoryData as $item)
                                @foreach ($item['sub_category'] as $data)
                                    <option value="{{ $data->id }}">{{ $data->s_c_name }}</option>
                                @endforeach
                            @endforeach
                        </select>
        
                        <!-- Search Button -->
                        <button><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </header>


    <script>
        const selectBox = document.getElementById('selectbox');
        const keywordInput = document.querySelector('.category');


        selectBox.addEventListener('change', () => {
            const selectedCategory = selectBox.value;
            keywordInput.value = selectedCategory;

        });

        let search = document.getElementById('search');
        let searchbox = document.getElementById('searchbox');
        let x = 0;

        search.addEventListener('click', () => {
            if (x == 0) {
                searchbox.style.display = 'block';
                x = 1;
            } else {
                searchbox.style.display = 'none';
                x = 0;
            }
        });


        document.addEventListener('click', (e) => {
            if (!search.contains(e.target) && !searchbox.contains(e.target)) {
                searchbox.style.display = 'none';
                x = 0;
            }
        });
    </script>
@endsection
