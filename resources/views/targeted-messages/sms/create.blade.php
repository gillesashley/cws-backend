@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="p-4 border rounded">
                    <h1>Create New SMS Campaign</h1>

                    <form class='row' action="{{ route('targeted-messages.sms.store') }}" method="POST">
                        @csrf

                        <div class="input-forms col-8">
                            <div class="form-group">
                                <label for="title">Campaign Title</label>
                                <input type="text" name="title" id="title" class="form-control" required
                                    maxlength="255" value="{{ old('title') }}">
                            </div><br>

                            <div class="form-group">
                                <label for="content">Message Content</label>
                                <textarea name="content" id="content" class="form-control" rows="10" required maxlength="160">{{ old('content') }}</textarea>
                            </div><br>

                            <div class="form-group">
                                <label>Recipients</label>
                                @foreach ($constituencyMembers as $member)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="recipients[]"
                                            value="{{ $member->id }}" id="member{{ $member->id }}">
                                        <label class="form-check-label" for="member{{ $member->id }}">
                                            {{ $member->name }} ({{ $member->phone }})
                                        </label>
                                    </div>
                                @endforeach
                            </div><br>

                            <button type="submit" class="btn btn-primary">Send SMS Campaign</button>
                        </div>

                        <ul class="recipient-items col-4">
                            <h3>Recipients</h3>
                            @foreach ($recipients ?? [] as $index => $recipient)
                                <div class="recipient-item">
                                    <label for="recipients[{{ $recipient->id }}]">
                                        {{ $recipient->name }}</label>
                                    <input id="recipients[{{ $recipient->id }}]" disabled readonly='true' type="checkbox"
                                        checked="intermediate">
                                </div>
                            @endforeach
                        </ul>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
