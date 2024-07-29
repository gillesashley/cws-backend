@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Campaigns</h1>
        <a href="{{ route('campaigns.create') }}" class="btn btn-primary mb-3">Create New Campaign</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Recipients</th>
                    <th>Success</th>
                    <th>Failure</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($campaigns as $campaign)
                    <tr>
                        <td>{{ $campaign['title'] }}</td>
                        <td>{{ $campaign['type'] }}</td>
                        <td>{{ $campaign['recipients_count'] }}</td>
                        <td>{{ $campaign['success_count'] }}</td>
                        <td>{{ $campaign['failure_count'] }}</td>
                        <td>{{ $campaign['created_at'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
