@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-6 offset-3">
        <div class="my-3 text-end">
            <a href="{{ route('customer#list')}}"><button class="btn btn-secondary">List Page</button></a>
         </div>

        <div class="card">
            <div class="card-header text-center">Customer Register Form</div>
            <div class="card-body">
                @if(Session::has('insertSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('insertSuccess') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <form action="{{ route('customer#create') }}" method="POST">
                    @csrf
                    <div class="my-2">
                        <label>Name</label>
                        <input type="text" name="userName" class="form-control" value="{{ old('userName') }}">
                        @if($errors->has('userName'))
                        <p class="text-danger">{{ $errors->first('userName') }}</p>
                        @endif
                    </div>
                    <div class="my-2">
                        <label>Email</label>
                        <input type="email" name="userEmail" class="form-control" value="{{ old('userEmail') }}">
                        @if($errors->has('userEmail'))
                        <p class="text-danger">{{ $errors->first('userEmail') }}</p>
                        @endif
                    </div>
                    <div class="my-2">
                        <label>Address</label>
                        <input type="text" name="userAddress" class="form-control" value="{{ old('userAddress') }}">
                        @if($errors->has('userAddress'))
                        <p class="text-danger">{{ $errors->first('userAddress') }}</p>
                        @endif
                    </div>
                    <div class="my-2">
                        <label>Gender</label>
                        <select name="userGender" class="form-control" value="{{ old('userGender') }}">
                            <option value="empty">Other Option.....</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                            <option value="0">Others</option>
                        </select>
                        @if($errors->has('userGender'))
                        <p class="text-danger">{{ $errors->first('userGender') }}</p>
                        @endif
                    </div>
                    <div class="my-2">
                        <label>Date of Birth</label>
                        <input type="date" name="dateOfBirth" class="form-control" value="{{ old('dateOfBirth')}}">
                        @if($errors->has('dateOfBirth'))
                        <p class="text-danger">{{ $errors->first('dateOfBirth') }}</p>
                        @endif
                    </div>
                    <div class="my-2">
                        <label>Phone Number</label>
                        <input type="number" name="userPhoneNumber" class="form-control" value="{{ old('userPhoneNumber') }}">
                        @if($errors->has('userPhoneNumber'))
                        <p class="text-danger">{{ $errors->first('userPhoneNumber') }}</p>
                        @endif
                    </div>
                    <div class="my-2 float-end">

                        <input type="submit" value="Register" class="btn bg-dark text-white">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
