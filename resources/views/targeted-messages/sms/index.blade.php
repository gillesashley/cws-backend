@extends('layouts.app')

@section('content')
<!--start breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Campaign With Us</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0 align-items-center">
                <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="mail" role="img"
                            class="md hydrated" aria-label="home outline"></ion-icon></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">SMS Campaign</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <button type="button" class="btn btn-outline-primary">Settings</button>
            <button type="button"
                class="btn btn-outline-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                    href="javascript:;">Action</a>
                <a class="dropdown-item" href="javascript:;">Another action</a>
                <a class="dropdown-item" href="javascript:;">Something else here</a>
                <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
            </div>
        </div>
    </div>
</div>
<!--end breadcrumb-->

    {{-- Create Sms campaign button --}}
        <a href="{{ route('targeted-messages.sms.create') }}" class="btn btn-primary mb-3">Create New SMS Campaign</a>
    {{-- end button  --}}

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