@extends('layoute.index')

@extends('fornt.nav')
@extends('fornt.footer')
@section('home')
<div class="bg-gray-100 container-fluid">
    <div class="row text-center mt-4 p-5">
        <div class="col-12">
            <h1 class="font-bold text-3xl">Signup</h1>
            <span><a href="{{ route('home') }}" class="no-underline text-gray-800">Home / </a></span>
            <span class="text-[#E2990F]">Signup</span>
        </div>
    </div>
</div>

<div class="bg-gray-100">
    <div class="container mx-auto">
        <div class="flex justify-center mt-10">
            <div class="w-full max-w-lg">
                <form action="{{ route('storesignup') }}" method="POST" autocomplete="off" class="shadow-lg p-6 bg-white rounded-lg">
                    @csrf
                    <h2 class="font-bold mb-4 text-2xl text-[#E2990F] border border-[#E2990F] inline-block p-2">Signup</h2>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block font-medium mb-1">Name</label>
                                <input type="text" class="border border-gray-300 p-2 rounded w-full" name="name" value="{{ old('name') }}" id="name focus:ring-2 focus:ring-[#E2990F]"  placeholder="Enter Your Name">
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block font-medium mb-1">Email Address</label>
                                <input type="email" class="border border-gray-300 p-2 rounded w-full" name='email' value="{{ old('email') }}" id="email focus:ring-2 focus:ring-[#E2990F]"  placeholder="Enter Your Email">
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="phone" class="block font-medium mb-1">Phone</label>
                            <input type="tel" class="border border-gray-300 p-2 rounded w-full" name='phone' value="{{ old('phone') }}" id="phone focus:ring-2 focus:ring-[#E2990F]"  placeholder="Enter Your Phone">
                            @error('phone')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="address" class="block font-medium mb-1">Address</label>
                            <input type="text" class="border border-gray-300 p-2 rounded w-full" name="address" value="{{ old('address') }}" id="address focus:ring-2 focus:ring-[#E2990F]"  placeholder="Enter Your Address">
                            @error('address')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="password" class="block font-medium mb-1">Password</label>
                                <input type="password" class="border border-gray-300 p-2 rounded w-full" name="password" id="password focus:ring-2 focus:ring-[#E2990F]"  placeholder="Enter Your Password">
                                @error('password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="password_confirmation" class="block font-medium mb-1">Confirm Password</label>
                                <input type="password" class="border border-gray-300 p-2 rounded w-full" name="password_confirmation" id="password_confirmation focus:ring-2 focus:ring-[#E2990F]"  placeholder="Enter Your Confirm Password">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="mt-6  bg-[#E2990F]  text-white p-2 rounded w-full hover:bg-[#E2990F] transition duration-200">Signup</button>
                    <p class="mt-4 text-center text-sm">Already have an account? <a href="{{ route('login') }}" class="text-[#E2990F] hover:underline">Click Login</a></p>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
