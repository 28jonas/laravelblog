@extends('layouts.backend')
@section('title', 'Products')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('backend.index') }}">Backend</a></li>
    <li class="breadcrumb-item active">Products</li>
@endsection
@section('cards')
@endsection
@section('charts')
@endsection
@section('content')
    <div class="container-fluid px-4">
        {{--@include('layouts.partials.flash_message')--}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">Products Beheer</h1>
            {{--@can('create', App\Models\Post::class)
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Nieuwe Post</a>
            @endcan--}}
        </div>

        <!-- Notificaties -->
        {{--<div class="mb-3">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-bell"></i> Notifications
                </div>
                <div class="card-body">
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <ul class="list-group">
                            @foreach(auth()->user()->unreadNotifications as $notification)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ $notification->data['url'] }}">
                                        New post: <strong>{{ $notification->data['title'] }}</strong> by {{ $notification->data['author'] }}
                                    </a>
                                    <form method="POST" action="{{ route('notifications.markAsRead', $notification->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-secondary">Mark as Read</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No new notifications.</p>
                    @endif
                </div>
            </div>
        </div>--}}

        {{--Filters--}}
        {{--<form method="GET" action="{{route('posts.index')}}" class="mb-3">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-filter"></i> Filter Posts
                </div>
                <div class="card-body">
                    <form method="GET" action="{{route('posts.index')}}">
                        <div class="row g-3">
                            --}}{{-- zoekveld--}}{{--
                            <div class="col-md-4">
                                <label for="search" class="form-label fw-bold">
                                    Search by Title or Content
                                </label>
                                <input type="text" name="search" id="search" class="form-control"
                                       placeholder="Enter Keyword..." value="{{request('search')}}">
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Categories</label>
                                <div class="d-flex flex-wrap">
                                    <div class="d-flex flex-wrap">
                                        @foreach($categories as $id => $name)
                                            <div class="form-check me-3">
                                                <input type="checkbox" name="category_ids[]" value="{{ $id }}" id="category-{{ $id }}"
                                                       class="form-check-input"
                                                    {{ in_array($id, request('category_ids', [])) ? 'checked' : '' }}>
                                                <label for="category-{{ $id }}" class="form-check-label">{{ $name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            --}}{{--                            filter en resetknop--}}{{--
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                                <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-sync-alt"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </form>--}}

        {{--Tabel orders--}}
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table me-1"></i> Overzicht van Orders</div>
            <div class="card-body">
                {{--<p class="text-muted">Showing {{ $orders->total() > 0 ? $orders->count() : 0 }} of {{ $orders->total() }} orders</p>--}}
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock Quantity</th>
                        <th>@sortablelink('created_at', 'Aangemaakt')</th>
                        <th>@sortablelink('updated_at', 'Bewerkt')</th>
                        <th>Acties</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock Quantity</th>
                        <th>Aangemaakt</th>
                        <th>Bewerkt</th>
                        <th>Acties</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name}}</td>
                            <td>{{ $product->slug }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->stock_quantity }}</td>
                            {{--<td>
                                @foreach($post->categories as $category)
                                    <span class="badge bg-info">{{ $category->name }}</span>
                                @endforeach
                            </td>--}}
                            <td>{{ $product->created_at->diffForHumans() }}</td>
                            <td>{{ $product->updated_at->diffForHumans() }}</td>
                            <td class="align-middle">
                                {{--<div class="d-flex gap-2">
                                    <a href="{{ route('posts.show', $post) }}"
                                       class="btn btn-sm btn-primary"
                                       title="Bekijk Post">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @can('update', $post)
                                        <a href="{{ route('posts.edit', $post) }}"
                                           class="btn btn-sm btn-info"
                                           title="Bewerk Post">
                                            <i class="fas fa-edit text-white"></i>
                                        </a>
                                    @endcan
                                    @can('delete', $post)
                                        <form method="POST" action="{{ route('posts.destroy', $post) }}" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    title="Verwijder Post"
                                                    onclick="return confirm('Weet je zeker dat je deze post wilt verwijderen?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>--}}
                                <!-- Show (View) button -->
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{--{{$posts->links()}}--}}
                {{--{!! $orders->appends(request()->except('page'))->render() !!}--}}
            </div>
        </div>
    </div>
@endsection
