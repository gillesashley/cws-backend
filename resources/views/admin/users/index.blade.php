@extends('layouts.app')

@section('content')
    <div class="ms-auto">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
            Add New User
        </button>
    </div>

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
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger show_confirm"
                                            data-toggle="tooltip" title='Delete'>Delete</button>
                                    </form>
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

        @include('admin.users.create', ['regions' => $regions, 'constituencies' => $constituencies])
    @endsection

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Do you want to continue',
                    icon: 'error',
                    confirmButtonText: 'Cool'
                })
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

                $('.show_confirm').click(function(event) {

                    var form = $(this).closest("form");

                    var name = $(this).data("name");

                    event.preventDefault();

                    swal({

                            title: `Are you sure you want to delete this record?`,

                            text: "If you delete this, it will be gone forever.",

                            icon: "warning",

                            buttons: true,

                            dangerMode: true,

                        })

                        .then((willDelete) => {

                            if (willDelete) {

                                form.submit();

                            }

                        });

                });

                // Sweet alert for delete
                $('.show_confirm').click(function(event) {
                    var form = $(this).closest("form");
                    var name = $(this).data("name");
                    event.preventDefault();
                    Swal.fire({
                        title: 'Are you sure you want to delete this record?',
                        text: "If you delete this, it will be gone forever.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });



                // Function to show Lobibox notification
                function showNotification(type, message) {
                    Lobibox.notify(type, {
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        icon: type === 'success' ? 'bx bx-check-circle' : 'bx bx-x-circle',
                        msg: message
                    });
                }

                // Show flash messages on page load
                @if (session('success'))
                    showNotification('success', "{{ session('success') }}");
                @endif

                @if (session('error'))
                    showNotification('error', "{{ session('error') }}");
                @endif
            });
        </script>
    @endpush
