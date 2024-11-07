@section('fornt.footer')
   
    <footer class="flex flex-wrap justify-between px-10  w-full h-auto bg-[#F7F7F7] md:py-9 py-5 mt-5">
        <div class="mt-3">
            <p class="font-bold text-md">UMA IMPORT INC</p>
            <p class="md:w-[390px] mt-3"> {{ $general->s_des }}</p>
        </div>

        <div class="mt-3">
            <p class="font-bold text-md">Shopping Category</p>
            <ul class="flex flex-col gap-3 mt-3">
                @foreach ($categoryData as $data)
                    <li ><a href="{{ route('searchByCategory',$data['category']->id) }}" class="text-black text-decoration-none">{{ $data['category']->category_name }}</a></li>
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
