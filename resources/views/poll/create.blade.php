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
                <label class="form-label" for="choices">Choices</label>
                <div id="choices">
                    <input type="text" class="form-control mb-2" name="choices[]">
                </div>
                @error('choices')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Create Poll</button>
                <button type="button" id="btn-add-choice" class="btn btn-secondary" disabled>Add Choice</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script>
    const choices = document.getElementById('choices');
    const btnChoice = document.getElementById('btn-add-choice');

    const setChoiceEvent = choice => {
        choice.addEventListener('keypress', e => {
            if (e.key != 'Enter') return;

            e.preventDefault();

            btnChoice.click();
            choices.lastChild.focus();

        });
        choice.addEventListener('keydown', e => {
            if (e.key != 'Backspace' || choice.value) return;

            choices.removeChild(choice);

            if (!choices.childElementCount)
                btnChoice.removeAttribute('disabled');

            choices.lastElementChild?.focus();
        });

        choice.addEventListener('input', e => {
            if (!choice.value)
                return btnChoice.setAttribute('disabled', '');

            btnChoice.removeAttribute('disabled');
        })
    }

    btnChoice.addEventListener('click', () => {
        if (choices.lastChild && choices.lastChild.value == false) return;

        const choice = document.createElement('input');
        choice.setAttribute('name', 'choices[]');
        choice.setAttribute('class', 'form-control mb-2');

        setChoiceEvent(choice);

        choices.appendChild(choice);
        btnChoice.setAttribute('disabled', '');
    });

    [...choices.children].forEach(child => {
        setChoiceEvent(child);
    })
</script>
@endsection