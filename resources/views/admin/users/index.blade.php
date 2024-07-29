// index.blade.php
@extends('layouts.app')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Users</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Users</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
                        Add New User
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Region</th>
                                    <th>Constituency</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user['name'] }}</td>
                                        <td>{{ $user['email'] }}</td>
                                        <td>{{ $user['role'] }}</td>
                                        <td>{{ $user['region']['name'] ?? 'N/A' }}</td>
                                        <td>{{ $user['constituency']['name'] ?? 'N/A' }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm">Edit</button>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if (isset($pagination))
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                @if ($pagination['current_page'] > 1)
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="{{ route('admin.users.index', ['page' => $pagination['current_page'] - 1]) }}"
                                            aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                @endif

                                @for ($i = 1; $i <= $pagination['total_pages']; $i++)
                                    <li class="page-item {{ $pagination['current_page'] == $i ? 'active' : '' }}">
                                        <a class="page-link"
                                            href="{{ route('admin.users.index', ['page' => $i]) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if ($pagination['current_page'] < $pagination['total_pages'])
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="{{ route('admin.users.index', ['page' => $pagination['current_page'] + 1]) }}"
                                            aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('admin.users.create')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endpush
