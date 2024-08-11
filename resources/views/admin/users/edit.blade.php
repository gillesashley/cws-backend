<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUserForm" method="POST" action="{{ route('admin.users.edit', ['user' => $user['id']]) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required
                            value={{ $user?->name }}>
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required
                            value='{{ $user?->email }}'>
                    </div>
                    <div class="mb-3">
                        <label for="edit_role" class="form-label">Role</label>
                        <select class="form-select" id="edit_role" name="role" require value='{{ $user?->role }}'>
                            <option value="user">User</option>
                            <option value="constituency_admin">Constituency Admin</option>
                            <option value="regional_admin">Regional Admin</option>
                            <option value="national_admin">National Admin</option>
                            <option value="application_admin">Super Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_region_id" class="form-label">Region</label>
                        <select class="form-select" id="edit_region_id" name="region_id" required
                            value="{{ $user?->region_id }}">
                            <option value="">Select Region</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_constituency_id" class="form-label">Constituency</label>
                        <select class="form-select" id="edit_constituency_id" name="constituency_id"
                            value='{{ $user?->constituency_id }}' required>
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
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>
