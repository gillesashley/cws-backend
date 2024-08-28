<!-- Blade Template -->
@extends('layouts.app')

@section('content')
    {{-- Breadcrumb --}}
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Users</div>

        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="people" role="img"
                                class="md hydrated" aria-label="home outline"></ion-icon></a>
                    </li>

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

                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                    <a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->


    {{-- <div class="ms-auto">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
            Add New Administrative User
        </button>
    </div><br> --}}

    <div class="card radius-10 w-100">
        <div class="card-body">
            <div class="d-flex align-items-center gap-5">
                <h6 class="mb-0">Users</h6>

                <form class="filter-role-opttionsp" name='filter-roles' action="{{ route('admin.users.index') }}">
                    @foreach (['user', 'constituency_admin', 'regional_admin', 'national_admin', 'application_admin'] as $key => $uRole)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="userRoles[{{ $key }}]"
                                id="userRoles[{{ $key }}]" value="{{ $uRole }}"  disabled
                                checked={{ in_array($uRole, $userRoles ?? []) }}>
                            <label class="form-check-label text-capitalize"
                                for="userRoles[{{ $key }}]">{{ str_replace('_', ' ', $uRole) }}
                            </label>
                        </div>
                    @endforeach


                    <button type="submit" class="btn btn-secondary btn-sm">Filter</button>
                </form>
            </div>
            <div class="fs-5 ms-auto dropdown">
                <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots"></i>
                </div>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div>
        </div><br>


        <table id="example" class="table-responsive table table-striped table-bordered align-middle mb-0"
            style="width:100%">
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
                        <td>{{ $users->firstItem() + $index }}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['role'] }}</td>
                        <td>{{ $user['region']['name'] ?? 'N/A' }}</td>
                        <td>{{ $user['constituency']['name'] ?? 'N/A' }}</td>
                        <td class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-primary edit-user-btn" data-bs-toggle="modal"
                                data-bs-target="#editUserModal" data-user="{{ $user?->toJson() }}">
                                Edit
                            </button>

                            <form action="{{ route('admin.users.destroy', ['user' => $user['id']]) }}" method="POST">
                                @csrf
                                {{ method_field('delete') }}
                                <button type="button" class="btn btn-sm btn-danger delete-user-btn"
                                    data-name="{{ $user->name }}">Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $users->links('vendor.pagination.syn-ui') }}
        </div>
    </div>
    </div>

    @include('admin.users.create', ['regions' => $regions, 'constituencies' => $constituencies])
    @include('admin.users.edit', ['regions' => $regions, 'constituencies' => $constituencies])
@endsection

@pushOnce('scripts')
    <script type="text/javascript">
        /** @typedef {import('jquery')} $ */
        $(document).ready(function() {

            // Filter constituencies based on selected region
            $('#region_id').change(function() {
                var regionId = $(this).val();
                var constituencySelect = $('#constituency_id');
                constituencySelect.find('option').show();
                if (regionId) {
                    constituencySelect.find('option').not('[data-region="' + regionId + '"]').hide();
                }
                constituencySelect.val('');
            });

            // Set password to email value before form submission
            $('#createUserForm').submit(function(e) {
                e.preventDefault();
                $('#password').val($('#email').val());

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log({
                            response
                        })
                        $('#createUserModal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error creating user:", error);
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            var errorMessage = errors[Object.keys(errors)[0]];
                            alert(errorMessage);
                        }
                    }
                });
            });

            // Populate edit form when Edit button is clicked
            $(document).on('click', '.edit-user-btn', function(event) {
                const user = JSON.parse(event.target.dataset.user)
                $('#editUserForm').attr('action', '/admin/users/' + user.id);
                $('#edit_name').val(user.name);
                $('#edit_email').val(user.email);
                $('#edit_role').val(user.role);
                $('#edit_region_id').val(user.region_id).trigger('change');
                setTimeout(function() {
                    $('#edit_constituency_id').val(user.constituency_id);
                }, 100);
            });


            // Event delegation for delete buttons
            $('.delete-user-btn').click(function(event) {
                console.log('delete button clicked');
                var userId = $(this).data('user-id');
                if (confirm(
                        'Are you sure you want to delete this user (' + event.target.dataset.name +
                        ')? This action cannot be undone.'
                    )) {

                    const form = event.target.closest('form')
                    form.submit();
                }
            });

            $('#region_id').change(function() {
                var regionId = $(this).val();
                var constituencySelect = $('#constituency_id');
                // show contituencies related to region
                constituencySelect.find('option').show();
                if (regionId) {
                    constituencySelect.find('option').not('[data-region="' + regionId + '"]').hide();
                }
                constituencySelect.val('');
            });


        });
    </script>
@endPushOnce
