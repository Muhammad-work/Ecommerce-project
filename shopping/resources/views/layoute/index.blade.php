<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ $general->s_title }} </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    {{-- <style>
        * {
            font-family: sans-serif;
        }

        #cart {
            position: relative;
        }

        #span {
            position: absolute;
            top: 12px;
            left: 55%;
            background: #47b547;
            color: #ffffff;
            padding: 0px 5px;
            border-radius: 50%;
            text-align: center;
            cursor: pointer;
        }

        .main {
            position: relative;
            transition: all ease 0.7s;
        }

        .quick-view {
            position: absolute;
            width: 100%;
            height: 40px;
            top: 40%;
            left: 0;
            background: #357448;
            display: flex;
            justify-content: center;
            align-items: center;
            visibility: hidden;
        }

        .quick-view a {
            color: white;
            text-decoration: none;
        }

        .main:hover .quick-view {
            visibility: visible;
            transition: all ease 0.7s;
        }

        ul li {
            list-style: none;
        }

        .card {
            height: 100%;
            /* Ensures all cards are the same height */
        }
    </style> --}}
</head>

<body>

    {{-- @yield('nav') --}}
    @yield('fornt.nav')

    @yield('fornt.imgslider')


    @yield('fornt.sidebar')
    @yield('home')

    @yield('fornt.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO9gyb2D7L3SAs6lHDCOya2TACJ6G7B9R4f1R23x4RzR3XYyWm0Wc" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-pzjw8f+ua7Kw1TIqD6K1vFQ0AZQw+1Hf6j+5tK5R1tkj0D/sW5DA3C4zfu5XaN7d" crossorigin="anonymous">
    </script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            autoplay: {
                delay: 2000, // 2 seconds delay between slides
                disableOnInteraction: false, // Continue autoplay after interaction
            },
            slidesPerView: 2,
            spaceBetween: 20,
            breakpoints: {
                640: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 4,
                },
                1024: {
                    slidesPerView: 5,
                },
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

</body>

</html>
