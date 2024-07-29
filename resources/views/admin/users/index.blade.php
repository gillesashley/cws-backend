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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Region</th>
                                    <th>Constituency</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
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

            // Fetch regions
            $.ajax({
                url: '{{ config('app.api_url') }}/regions',
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer {{ Session::get('access_token') }}'
                },
                success: function(response) {
                    var regions = response.data;
                    var regionSelect = $('#region_id');
                    regions.forEach(function(region) {
                        regionSelect.append($('<option></option>').attr('value', region.id)
                            .text(region.name));
                    });
                }
            });

            // Fetch constituencies when region is selected
            $('#region_id').change(function() {
                var regionId = $(this).val();
                if (regionId) {
                    $.ajax({
                        url: '{{ config('app.api_url') }}/regions/' + regionId + '/constituencies',
                        method: 'GET',
                        headers: {
                            'Authorization': 'Bearer {{ auth()->user()->api_token }}'
                        },
                        success: function(response) {
                            var constituencies = response.data;
                            var constituencySelect = $('#constituency_id');
                            constituencySelect.empty().append($('<option></option>').attr(
                                'value', '').text('Select Constituency'));
                            constituencies.forEach(function(constituency) {
                                constituencySelect.append($('<option></option>').attr(
                                    'value', constituency.id).text(constituency
                                    .name));
                            });
                        }
                    });
                } else {
                    $('#constituency_id').empty().append($('<option></option>').attr('value', '').text(
                        'Select Constituency'));
                }
            });

            // Set password to email value before form submission
            $('#createUserForm').submit(function() {
                $('#password').val($('#email').val());
            });

            // Handle form submission
            $('#createUserForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    headers: {
                        'Authorization': 'Bearer {{ auth()->user()->api_token }}'
                    },
                    success: function(response) {
                        $('#createUserModal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr) {
                        // Handle errors
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
