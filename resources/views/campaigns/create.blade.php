@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New SMS Campaign</h1>

        <form action="{{ route('campaigns.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" id="message" class="form-control" rows="3" required maxlength="160">{{ old('message') }}</textarea>
            </div>

            <div class="form-group">
                <label>Recipients</label>
                @foreach ($constituencyMembers as $member)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="recipients[]" value="{{ $member['id'] }}"
                            id="member{{ $member['id'] }}">
                        <label class="form-check-label" for="member{{ $member['id'] }}">
                            {{ $member['name'] }} ({{ $member['phone'] }})
                        </label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Send SMS Campaign</button>
        </form>
    </div>
@endsection
