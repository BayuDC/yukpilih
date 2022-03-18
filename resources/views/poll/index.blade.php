@extends('layouts.main')
@section('content')

<div class="row">
    @foreach($polls as $poll)
    <div class="col-md-6 col-12 mb-4">
        <div class="bg-light border p-3 mb-3 h-100">
            <h3>{{ $poll->title }}</h3>
            <div class="text-muted">created by: {{ $poll->creator->username }} | deadline: {{ $poll->deadline }} </div>
            <div>{{ $poll->description }}</div>
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
            @else
            @foreach($poll->choices as $choice)
            <div class="mt-2">
                <div>
                    {{ $choice->choice }} | {{ $point = round($poll->totalPoint == 0 ? 0 : $choice->point / $poll->totalPoint * 100, 2)}}%
                </div>
                <div class="bg-secondary bg-opacity-10">
                    <div class="bg-primary" style="height: 12px; width: {{ $point }}%"></div>
                </div>
            </div>
            @endforeach
            @endcan
        </div>
    </div>
    @endforeach
</div>

@endsection