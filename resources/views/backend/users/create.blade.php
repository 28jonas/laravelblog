@extends('layouts.backend')
@section('title')
    Create a User
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('backend.index') }}">Backend</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Users</a></li>
    <li class="breadcrumb-item active">Create User</li>
@endsection

@section('charts')
@endsection()
@section('content')
    <div class="container-fluid px-4">
        <div>
            @include("layouts.partials.form_error")
        </div>
        <form action="{{action('\App\Http\Controllers\UserController@store')}}" method="POST" enctype="multipart/form-data"   >
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control @error('name') border-danger @enderror"
                    value="{{old('name')}}"
                >
                @error('name')
                    <p class="text-danger text-sm">{{$message}}</p>
                @enderror
                <label for="email">Email:</label>
                <input
                    type="text"
                    name="email"
                    id="email"
                    class="form-control"
                    value="{{old('email')}}"
                >
                <label for="role_id">Select Role:(ctrl+ click to select multiple)</label>
                <select class="form-select" name="role_id[]" id="role_id" multiple>
                    <option value="" disabled>Select Role</option>
                    @foreach($roles as $id => $role)
                        <option value="{{$id}}">{{$role}}</option>
                    @endforeach
                </select>
                <label for="role_id">Select status:</label>
                <select class="form-select" name="is_active" id="is_active">
                    <option value="1" {{old('is_active')==1 ? 'selected':""}}>Active</option>
                    <option value="0" {{old('is_active')==0 ? 'selected':""}}>Not active</option>
                </select>
                <label for="password">Password:</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                >
                <label for="photo_id">Image:</label>
                <input
                    type="file"
                    name="photo_id"
                    id="photo_id"
                    class="form-control"
                >
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create User</button>
            </div>
        </form>
    </div>

@endsection
