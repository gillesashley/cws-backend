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


    <div class="ms-auto">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
            Add New Administrative User
        </button>
    </div><br>

    <div class="card radius-10 w-100">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h6 class="mb-0">Users</h6>
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
            </div>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered align-middle mb-0" style="width:100%">
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
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary edit-user-btn"
                                        data-bs-toggle="modal" data-bs-target="#editUserModal"
                                        data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}"
                                        data-user-email="{{ $user->email }}" data-user-role="{{ $user->role }}"
                                        data-user-region="{{ $user->region_id }}"
                                        data-user-constituency="{{ $user->constituency_id }}">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger delete-user-btn"
                                        data-user-id="{{ $user->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $users->links('vendor.pagination.syn-ui') }}
            </div>
        </div>
    </div>

        @include('admin.users.create', ['regions' => $regions, 'constituencies' => $constituencies])
        @include('admin.users.edit', ['regions' => $regions, 'constituencies' => $constituencies])
    @endsection

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#example').DataTable({
                    "paging": false,
                    "info": false,
                    "searching": false
                });

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
                $(document).on('click', '.edit-user-btn', function() {
                    var userId = $(this).data('user-id');
                    var userName = $(this).data('user-name');
                    var userEmail = $(this).data('user-email');
                    var userRole = $(this).data('user-role');
                    var userRegion = $(this).data('user-region');
                    var userConstituency = $(this).data('user-constituency');

                    $('#editUserForm').attr('action', '/admin/users/' + userId);
                    $('#edit_name').val(userName);
                    $('#edit_email').val(userEmail);
                    $('#edit_role').val(userRole);
                    $('#edit_region_id').val(userRegion).trigger('change');
                    setTimeout(function() {
                        $('#edit_constituency_id').val(userConstituency);
                    }, 100);
                });

                // Handle edit form submission
                $('#editUserForm').submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'PUT',
                        data: $(this).serialize(),
                        success: function(response) {
                            $('#editUserModal').modal('hide');
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error("Error updating user:", error);
                            var errors = xhr.responseJSON.errors;
                            if (errors) {
                                var errorMessage = errors[Object.keys(errors)[0]];
                                alert(errorMessage);
                            }
                        }
                    });
                });

                // Event delegation for delete buttons
                $('.delete-user-btn').click(function() {
                    console.log('delete button clicked');
                    var userId = $(this).data('user-id');
                    if (confirm(
                            'Are you sure you want to delete this user? This action cannot be undone.'
                        )) {
                        var form = $('<form>', {
                            'method': 'DELETE',
                            'action': '{{ route('admin.users.destroy', ':user_id') }}'
                                .replace(
                                    ':user_id', userId)
                        });
                        form.append('@csrf');
                        form.append('@method('DELETE')');
                        $('body').append(form);
                        form.submit();
                    }
                });

                // $('#region_id').change(function() {
                //     var regionId = $(this).val();
                //     var constituencySelect = $('#constituency_id');
                //     constituencySelect.find('option').show();
                //     if (regionId) {
                //         constituencySelect.find('option').not('[data-region="' + regionId + '"]').hide();
                //     }
                //     constituencySelect.val('');
                // });

                // Function to show standard JavaScript alert
                function showAlert(message) {
                    alert(message);
                }

                // Show flash messages on page load
                @if (session('success'))
                    showAlert("{{ session('success') }}");
                @endif

                @if (session('error'))
                    showAlert("{{ session('error') }}");
                @endif
            });
        </script>
    @endpush
