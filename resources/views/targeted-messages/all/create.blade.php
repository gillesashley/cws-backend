@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="p-4 border rounded">
                    <h1>Create Affliate Campaign Message</h1>

                    <form action="{{ route('targeted-messages.all.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Campaign Title</label>
                            <input type="text" name="title" id="title" class="form-control" required maxlength="255"
                                value="{{ old('title') }}">
                        </div><br>

                        <div class="form-group">
                            <label for="content">Message Content</label>
                            <textarea name="content" id="content" class="form-control" rows="10" required maxlength="160">{{ old('content') }}</textarea>
                        </div><br>
                        <div class="form-group">
                            <label for="media">Media (Optional)</label>
                            <input type="file" name="media[]" id="media" class="form-control-file"
                                accept="image/*,video/*" multiple>
                        </div><br>

                        {{-- <div class="form-group">
                    <label>Recipients</label>
                    @foreach ($constituencyMembers as $member)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="recipients[]" value="{{ $member->id }}"
                                id="member{{ $member->id }}">
                            <label class="form-check-label" for="member{{ $member->id }}">
                                {{ $member->name }} ({{ $member->phone }})
                            </label>
                        </div>
                    @endforeach
                </div><br> --}}

                        <button type="submit" class="btn btn-primary">Send Campaign Message</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
