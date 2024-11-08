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

    <div class=" flex justify-center place-content-center  mt-4">
        <div class="bg-white md:w-[50%] p-4 rounded-md  shadow-lg">
            <h2 class="text-center font-bold text-2xl  mb-3">Update User Information</h2>
            <form action="{{ route('storeUser', $user->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="block text-gray-700 font-semibold">Name</label>
                    <input type="text"
                        class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-[#E2990F]"
                        name="name" value="{{ $user->name }}" id="exampleInputEmail1" required>
                    {{-- <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                        required> --}}
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="block text-gray-700 font-semibold">Email</label>
                    <input type="email"
                        class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-[#E2990F]"
                        name="email" value="{{ $user->email }}" id="exampleInputEmail1" required>
                    {{-- <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                        required> --}}
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="block text-gray-700 font-semibold">Phone</label>
                    <input type="Number"
                        class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-[#E2990F]"
                        name="phone" value="{{ $user->phone }}" id="exampleInputEmail1" required>
                    {{-- <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}"
                        required> --}}
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="block text-gray-700 font-semibold">Address</label>
                    <input type="text"
                        class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-[#E2990F]"
                        name="address" value="{{ $user->address }}" id="exampleInputEmail1" required>
                    {{-- <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}"
                        required> --}}
                </div>
                <a href="{{ route('viewProfile') }}" class="bg-[#DA9509] px-3 py-2 rounded-md font-bold decoration-none text-white">Back</a>
                <button type="submit" class="bg-[#DA9509] px-3 py-2 rounded-md font-bold decoration-none text-white">Update</button>
            </form>
        </div>
    </div>
    <div class="col-9 mt-4">
        <div class="card-body">

        </div>
    </div>
@endsection
