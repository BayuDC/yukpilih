@extends('layouts.main')
@section('content')

<div class="row">
    @foreach($polls as $poll)
    <div class="col-md-6 col-12">
        <div class="bg-light border p-3 mb-3">
            <h3>{{ $poll->title }}</h3>
            <p class="text-muted">created by {{ $poll->creator->username }}</p>
            <p>{{ $poll->description }}</p>
            @if(Auth::user()->role == 'user')
            @foreach($poll->choices as $choice)
            <div class="mb-2">
                <button class="btn btn-dark">{{ $choice->choice }}</button>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    @endforeach
</div>

@endsection