@extends('layouts.app')

@section('title', 'SMS Campaigns')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Send SMS Campaign</h5>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form action="{{ route('sms-campaigns.send') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="3" maxlength="160" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Recipients</label>
                            @foreach ($constituencyMembers as $member)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="recipients[]"
                                        value="{{ $member['phone'] }}" id="member{{ $member['id'] }}">
                                    <label class="form-check-label" for="member{{ $member['id'] }}">
                                        {{ $member['name'] }} ({{ $member['phone'] }})
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Send SMS Campaign</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
