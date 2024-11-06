@section('fornt.sidebar')
<div class="flex   w-full fixed top-0 left-0  -translate-x-full duration-[0.5s] z-0 " id="sidebarmenu">
    <!-- Sidebar -->
    <div class="bg-dark text-white w-64 h-screen p-3 relative">
        <div class="text-center p-3 relative">
            <i class="fa-solid fa-x absolute top-5 right-5 cursor-pointer" id="cancenmenu"></i> 
            @php
                $profileImage = Auth::user()->img ? asset('storage/' . Auth::user()->img) : null;
                $firstLetter = strtoupper(substr(Auth::user()->name, 0, 1));
            @endphp

            @if ($profileImage)
                <img class="w-20 h-20 mx-auto mb-2 rounded-full" src="{{ $profileImage }}" alt="User Image">
            @else
                <div class="bg-primary rounded-full mb-2 m-auto w-20 h-20 flex items-center justify-center text-white text-xl">
                    {{ $firstLetter }}
                </div>
            @endif

            <h5 class="text-xl font-semibold">{{ Auth::user()->name }}</h5>
            <span class="upload-icon absolute bottom-[57px] left-[42%] transform -translate-x-1/2 cursor-pointer text-blue-500"
                data-bs-toggle="modal" data-bs-target="#uploadModal">
                <div class="bg-white rounded-full w-8 h-8 flex items-center justify-center">
                    +
                </div>
            </span>
        </div>
        
        <ul class="space-y-4">
            <li>
                <a class="flex items-center text-white hover:bg-gray-600 p-2 rounded" href="{{ route('viewProfile') }}">
                    <i class="fas fa-user mr-2"></i> Profile Overview
                </a>
            </li>
            <li>
                <a class="flex items-center text-white hover:bg-gray-600 p-2 rounded" href="{{ route('viewAllOrders') }}">
                    <i class="fas fa-box mr-2"></i> Orders
                </a>
            </li>

            <li>
                <a class="flex items-center text-white hover:bg-gray-600 p-2 rounded" href="3" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

    <!-- Modal for Uploading Image -->
</div>
<div class="modal fade " id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('updateUserImg', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload New Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="file" class="form-control" name="profile_image" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    /* Tailwind already handles transitions, but if you want to customize */
    .sidebar {
        transition: background-color 0.3s;
    }

    .sidebar:hover {
        background-color: #495057;
    }

    .upload-icon {
        cursor: pointer;
        color: #007bff;
        font-size: 20px;
        position: relative;
    }

    .nav-link {
        transition: background-color 0.3s, color 0.3s;
    }

    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #007bff;
    }
</style>


    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMr6tK/z6x+URy7W/N2S5ZsTkPjkG8f4j6j0o9" crossorigin="anonymous">
    

@endsection
