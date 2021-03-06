@extends('layouts.blank');
@section('content')
<div class="row d-flex align-items-center justify-content-center vh-100 px-3">
    <div class="col bg-light p-4 border" style="max-width: 400px">
        <form action="/login" method="post">
            @csrf
            <div class="mb-4">
                <h3>
                    {{ config('app.name') }} - Login
                </h3>
            </div>
            <div class="mb-2">
                <label for="username" class="form-label">Username</label>
                <input type="text" value="{{ old('username') }}" name="username" id="username" class="form-control">
                @error('username')
                <small class="text-danger text-end d-block ms-auto">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Pasword</label>
                <input type="password" name="password" id="password" class="form-control">
                @error('password')
                <small class="text-danger text-end d-block ms-auto">{{ $message }}</small>
                @enderror
            </div>
            @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <div>
                <button type="submit" class="btn btn-primary ms-auto d-block">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection