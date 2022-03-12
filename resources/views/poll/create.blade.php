@extends('layouts.main')
@section('content')

<h2 class="pb-3">Add Poll</h2>

<div class="row">
    <div class="col-lg-4 col-md-6 col">

        <form action="/poll" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="4"></textarea>
            </div>
            <div class="mb-3">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="datetime-local" class="form-control" name="deadline" id="deadline">
            </div>
            <div class="mb-3">
                <label class="form-label">Choice 1</label>
                <input type="text" class="form-control mb-2">
            </div>
            <div class="mb-3">
                <label class="form-label">Choice 2</label>
                <input type="text" class="form-control mb-2">
            </div>
            <div class="mb-4">
                <label class="form-label">Choice 3</label>
                <input type="text" class="form-control mb-2">
            </div>
            <div>
                <button class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>

@endsection