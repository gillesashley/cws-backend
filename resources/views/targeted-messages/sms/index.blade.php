@extends('layouts.app')

@section('content')
<div class="container">
    <h1>SMS Campaigns</h1>
    <a href="{{ route('targeted-messages.sms.create') }}" class="btn btn-primary mb-3">Create New SMS Campaign</a>

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Recipients</th>
                <th>Success</th>
                <th>Failure</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
                <tr>
                    <td>{{ $message->title }}</td>
                    <td>{{ $message->recipients_count }}</td>
                    <td>{{ $message->success_count }}</td>
                    <td>{{ $message->failure_count }}</td>
                    <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $messages->links() }}
</div>
@endsection