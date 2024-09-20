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
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}" required>
                    </div>
                    <input type="hidden" id="password" name="password" value="{{ old('password') }}">
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="constituency_admin"
                                {{ old('role') == 'constituency_admin' ? 'selected' : '' }}>Constituency Admin</option>
                            <option value="regional_admin" {{ old('role') == 'regional_admin' ? 'selected' : '' }}>
                                Regional Admin</option>
                            <option value="national_admin" {{ old('role') == 'national_admin' ? 'selected' : '' }}>
                                National Admin</option>
                            <option value="application_admin"
                                {{ old('role') == 'application_admin' ? 'selected' : '' }}>Super Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="region_id" class="form-label">Region</label>
                        <select class="form-select" id="region_id" name="region_id" required>
                            <option value="">Select Region</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}"
                                    {{ old('region_id') == $region->id ? 'selected' : '' }}>{{ $region->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="constituency_id" class="form-label">Constituency</label>
                        <select class="form-select" id="constituency_id" name="constituency_id" required>
                            <option value="">Select Constituency</option>
                            @foreach ($constituencies as $constituency)
                                <option value="{{ $constituency->id }}" data-region="{{ $constituency->region_id }}"
                                    {{ old('constituency_id') == $constituency->id ? 'selected' : '' }}>
                                    {{ $constituency->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ old('phone') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ old('address') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="date_of_birth"
                            value="{{ old('date_of_birth') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    {{-- 'password',
        'date_of_birth',
        'ghana_card_id',
        'ghana_card_image_path',
        'constituency_id',
        'region_id',
        'area', --}}
                    <div class="mb-3">
                        <label for="ghana_card_id" class="form-label">Ghana Card ID</label>
                        <input type="text" class="form-control" id="ghana_card_id" name="ghana_card_id"
                            value="{{ old('ghana_card_id') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="ghana_card_image" class="form-label">Ghana Card Image</label>
                        <input type="file" class="form-control" id="ghana_card_image" name="ghana_card_image"
                            value="{{ old('ghana_card_image') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="area" class="form-label">Area</label>
                        <input type="text" class="form-control" id="area" name="area"
                            value="{{ old('area') }}" required>
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
