
@extends('layouts.backend')
@section('title')
    Users
@endsection


@section('charts')
@endsection()
@section('content')
    @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable Example
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Role</th>
                    <th>Active</th>
                    <th>Created</th>
                    <th>Update</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>id</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Role</th>
                    <th>Active</th>
                    <th>Created</th>
                    <th>Update</th>
                </tr>
                </tfoot>
                <tbody>

                @if($users)
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->photo_id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <div>
                                    @foreach($user->roles as $role)
                                        <span class="badge rounded-pill text-bg-primary">{{$role->name}}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <div
                                    class="{{$user->is_active==1 ? 'badge rounded-pill text-bg-success':'badge rounded-pill text-bg-danger'}}">
                                    {{$user->is_active==1 ? 'Active':'No active'}}
                                </div>
                            </td>
                            <td>{{$user->created_at->diffForHumans()}}</td>
                            <td>{{$user->updated_at->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                @endif

                </tbody>
            </table>
        </div>
    </div>
    <div class="card mb-4">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>id</th>
                <th>Photo</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Role</th>
                <th>Active</th>
                <th>Created</th>
                <th>Update</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>id</th>
                <th>Photo</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Role</th>
                <th>Active</th>
                <th>Created</th>
                <th>Update</th>
            </tr>
            </tfoot>
            <tbody>

            @if($users)
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->photo_id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <div>
                                @foreach($user->roles as $role)
                                    <span class="badge rounded-pill text-bg-primary">{{$role->name}}</span>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <div
                                class="{{$user->is_active==1 ? 'badge rounded-pill text-bg-success':'badge rounded-pill text-bg-danger'}}">
                                {{$user->is_active==1 ? 'Active':'No active'}}
                            </div>
                        </td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>{{$user->updated_at->diffForHumans()}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <div>
            {{$users->links()}}
        </div>
@endsection
