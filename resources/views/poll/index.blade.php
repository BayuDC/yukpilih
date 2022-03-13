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
                <form action="/poll/vote" method="post">
                    @csrf
                    <input type="hidden" name="poll" value="{{ $poll->id }}">
                    <input type="hidden" name="choice" value="{{ $choice->id }}">
                    <button type="submit" class="btn btn-dark">{{ $choice->choice }}</button>
                </form>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    @endforeach
</div>

@endsection