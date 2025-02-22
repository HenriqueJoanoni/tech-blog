<!-- Modal -->
<div class="modal fade" id="user-permission-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    Updating permissions of <b><span id="user-name"></span></b>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="update-permission-form" action="{{ route('admin.update-permissions') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="user-id" name="user_id" value="">
                    <input type="hidden" id="current-permission-id" name="current_permission_id" value="">

                    <!-- Dropdown for permissions -->
                    <div class="form-group mb-3">
                        <label for="permission-dropdown">Select Permission</label>
                        <select class="form-control" id="permission-dropdown" name="permission_id">
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->permission_title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Permissions</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
