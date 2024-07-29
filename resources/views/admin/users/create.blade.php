<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="createUserForm" action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <input type="hidden" id="password" name="password">
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="user">User</option>
                            <option value="constituency_admin">Constituency Admin</option>
                            <option value="regional_admin">Regional Admin</option>
                            <option value="national_admin">National Admin</option>
                            <option value="super_admin">Super Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="region_id" class="form-label">Region</label>
                        <select class="form-select" id="region_id" name="region_id" required>
                            <option value="">Select Region</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="constituency_id" class="form-label">Constituency</label>
                        <select class="form-select" id="constituency_id" name="constituency_id" required>
                            <option value="">Select Constituency</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            console.log('Document ready');
            console.log('API URL:', '{{ config('app.api_url') }}');

            // Fetch regions
            $.ajax({
                url: '{{ config('app.api_url') }}/regions',
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                },
                success: function(response) {
                    console.log('Regions fetched successfully:', response);
                    var regions = response.data;
                    var regionSelect = $('#region_id');
                    regionSelect.empty().append($('<option></option>').attr('value', '').text(
                        'Select Region'));
                    regions.forEach(function(region) {
                        regionSelect.append($('<option></option>').attr('value', region.id)
                            .text(region.name));
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching regions:");
                    console.error("Status:", status);
                    console.error("Error:", error);
                    console.error("Response:", xhr.responseText);
                    console.error("Status Code:", xhr.status);
                    alert("Failed to load regions. Please check the console for more information.");
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
                            'Accept': 'application/json'
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
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching constituencies:", error);
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
                        'Authorization': 'Bearer {{ Session::get('access_token') }}'
                    },
                    success: function(response) {
                        $('#createUserModal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error creating user:", error);
                        // Handle errors (e.g., display error messages)
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            var errorMessage = errors[Object.keys(errors)[0]];
                            alert(errorMessage);
                        }
                    }
                });
            });
        });
    </script>
@endpush
