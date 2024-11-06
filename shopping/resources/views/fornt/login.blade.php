@extends('layoute.index')

@extends('fornt.nav')
@extends('fornt.footer')
@section('home')
<div class="bg-gray-100 w-full">
    <div class="flex flex-col items-center text-center mt-4 p-5">
        <h1 class="text-3xl font-bold">Login</h1>
        <div class="mt-2">
            <a href="{{ route('home') }}" class="text-gray-800 hover:text-gray-600 text-decoration-none">Home</a>
            <span class="text-gray-500">/</span>
            <span class="text-[#E2990F]">Login</span>
        </div>
    </div>
</div>


<div class="flex justify-center items-center min-h-screen bg-gray-100 p-4 sm:p-8">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6 sm:p-8">
        <form action="{{ route('storeLogin') }}" method="POST" class="space-y-6">
            @csrf
            <h2 class="text-2xl font-bold text-[#E2990F] border border-[#E2990F] inline-block px-4 py-2 mb-4">Login</h2>
            
            @if (session('email'))
                <div class="bg-blue-100 text-blue-700 border-l-4 border-blue-500 p-3 rounded mb-4" role="alert">
                    {{ session('email') }}
                </div>
            @endif

            <div>
                <label for="exampleInputEmail1" class="block text-gray-700 font-semibold">Email address</label>
                <input type="email" class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-[#E2990F]" name="email" id="exampleInputEmail1">
            </div>

            <div>
                <label for="exampleInputPassword1" class="block text-gray-700 font-semibold">Password</label>
                <input type="password" class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-[#E2990F]" name="password" id="exampleInputPassword1">
            </div>

            <button type="submit" class="w-full bg-[#E2990F] text-white font-semibold py-2 rounded-lg hover:bg-[#E2990F]transition duration-300">Login</button>

            <p class="text-center mt-4">Create New Account? 
                <a href="{{ route('signup') }}" class="text-[#E2990F] hover:underline">Click Signup</a>
            </p>
        </form>
    </div>
</div>


@endsection
