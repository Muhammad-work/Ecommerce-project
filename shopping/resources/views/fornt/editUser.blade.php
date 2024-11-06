@extends('layoute.index')

@extends('fornt.nav')
@extends('fornt.footer')
@extends('fornt.sidebar')

@section('home')
  <style>
    body{
        overflow-x: hidden;
    }
  </style>
 <div class="col-9 mt-4">
      <div class="card-body">
        <h2 class="text-center">Update User Information</h2>
    <form action="{{ route('storeUser',$user->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" required>
        </div>
        <a href="{{ route('viewProfile') }}" class="btn btn-primary">Back</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
      </div>
 </div>
@endsection