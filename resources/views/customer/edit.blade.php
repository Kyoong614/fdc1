@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-6 offset-3">
        <div class="card">
            <div class="card-head fs-3 text-center fs-3 bg-dark text-white">
                Customer Edit Data
            </div>
            <div class="card-body fs-4">
                @if(Session::has('updateSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('updateSuccess') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <form action="{{ route('customer#update',$customer->customer_id) }}" method="post">
                    @csrf
                    <div class="my-3">
                        <label>Name</label>
                        <input type="text" name="userName" class="form-control" value="{{ old('userName',$customer->name )}}">
                        @if($errors->has('userName'))
                        <small class="text-danger">{{ $errors->first('userName') }}</small>
                        @endif
                    </div> <div class="my-3">
                        <label>Email</label>
                        <input type="text" name="userEmail" class="form-control" value="{{ old('userEmail',$customer->email) }}">
                        @if($errors->has('userEmail'))
                        <small class="text-danger">{{ $errors->first('userEmail') }}</small>
                        @endif
                    </div>
                    <div class="my-3">
                        <label>Address</label>
                        <textarea name="userAddress" cols="30" row="4" class="form-control">{{ old('userAddress',$customer->address )}}
                        </textarea>
                        @if($errors->has('userAddress'))
                        <small class="text-danger">{{ $errors->first('userAddress') }}</small>
                        @endif
                    </div>
                    <div class="my-3">
                        <label>Phone</label>
                        <input type="number" name="userPhoneNumber" class="form-control" value="{{ old('userPhoneNumber',$customer->phone)}}">
                        @if($errors->has('userPhoneNumber'))
                        <small class="text-danger">{{ $errors->first('userPhoneNumber') }}</small>
                        @endif
                    </div>
                    <div class="my-3">
                        <label>Gender</label>
                        <select name="userGender" class="form-control">
                            @if($customer->gender == 1)
                            <option value="empty">Choose options...</option>
                            <option value="1" selected>Male</option>
                            <option value="2">Female</option>
                            <option value="0">Others</option>
                            @elseif($customer->gender == 2)
                            <option value="empty">Choose options...</option>
                            <option value="1">Male</option>
                            <option value="2" selected>Female</option>
                            <option value="0">Others</option>
                            @elseif($customer->gender == 0)
                            <option value="empty">Choose options...</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                            <option value="0" selected>Others</option>
                            @endif
                        </select>
                        @if($errors->has('userGender'))
                        <small class="text-danger">{{ $errors->first('userGender') }}</small>
                        @endif
                     </div>
                    <div class="my-3">
                        <label>DOB</label>
                        <input type="date" name="dateOfBirth" class="form-control" value="{{ old('dateOfBirth',$customer->date_of_birth) }}">
                        @if($errors->has('dateOfBirth'))
                        <small class="text-danger">{{ $errors->first('dateOfBirth') }}</small>
                        @endif
                    </div>
                    <div class="my-3 float-end">
                            <input type="submit" value="Update" class="btn bg-danger text-white">
                    </div>
                </form>


            </div>
            <div class="card-footer">
                    <a href="{{ route('customer#list') }}">
                        <button class="btn btn-sm bg-dark text-white">Back</button></a>
            </div>

            </div>
        </div>
    </div>


@endsection
