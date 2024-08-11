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
                            <option value="application_admin">Super Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="region_id" class="form-label">Region</label>
                        <select class="form-select" id="region_id" name="region_id" required>
                            <option value="">Select Region</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="constituency_id" class="form-label">Constituency</label>
                        <select class="form-select" id="constituency_id" name="constituency_id" required>
                            <option value="">Select Constituency</option>
                            @foreach ($constituencies as $constituency)
                                <option value="{{ $constituency->id }}" data-region="{{ $constituency->region_id }}">
                                    {{ $constituency->name }}</option>
                            @endforeach
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
