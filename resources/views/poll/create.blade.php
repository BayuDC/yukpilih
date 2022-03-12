@extends('layouts.main')
@section('content')

<h2 class="pb-3">Add Poll</h2>

<div class="row">
    <div class="col-lg-4 col-md-6 col">

        <form action="/poll" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" value="{{ old('title') }}" class="form-control" name="title" id="title">
                @error('title')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="4">{{ old('description') }}</textarea>
                @error('description')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="datetime-local" class="form-control" name="deadline" id="deadline" value="{{ old('deadline') }}">
                @error('deadline')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="choice1">Choice 1</label>
                <input type="text" value="{{ old('choice1') }}" class="form-control mb-2" name="choice1" id="choice1">
                @error('choice1')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="choice2">Choice 3</label>
                <input type="text" value="{{ old('choide2') }}" class="form-control mb-2" name="choice2" id="choice2">
                @error('choice2')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label" for="choice3">Choice 3</label>
                <input type="text" value="{{ old('choice3') }}" class="form-control mb-2" name="choice3" id="choice3">
                @error('choice3')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <button class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>

@endsection