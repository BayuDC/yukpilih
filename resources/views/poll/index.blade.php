@extends('layouts.main')
@section('content')

<div class="row">
    @foreach($polls as $poll)
    <div class="col-md-6 col-12">
        <div class="bg-light border p-3 mb-3 h-100">
            <h3>{{ $poll->title }}</h3>
            <p class="text-muted">created by {{ $poll->creator->username }}</p>
            <p>{{ $poll->description }}</p>
            @can('vote-poll', $poll)
            @foreach($poll->choices as $choice)
            <div class="mb-2">
                <form action="/poll/{{ $poll->id }}/vote" method="post">
                    @csrf
                    <input type="hidden" name="choice" value="{{ $choice->id }}">
                    <button type="submit" class="btn btn-dark">{{ $choice->choice }}</button>
                </form>
            </div>
            @endforeach
            @endcan
        </div>
    </div>
    @endforeach
</div>

@endsection