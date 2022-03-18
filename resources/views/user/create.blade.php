@extends('layouts.main')
@section('content')

<h2 class="pb-3">Register User</h2>

<div class="row">
    <div class="col-lg-4 col-md-6 col">
        <form action="/user" method="post">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" value="{{ old('username') }}" class="form-control" name="username" id="username">
                @error('username')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-4">
                <label for="division" class="form-label">Division</label>
                <input type="text" value="{{ old('division') }}" class="form-control" name="division" id="division">
                @error('division')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Register User</button>
        </form>
    </div>
</div>
@endsection