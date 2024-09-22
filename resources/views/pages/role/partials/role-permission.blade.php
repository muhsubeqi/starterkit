@php
    $permissionGroups = Spatie\Permission\Models\Permission::select('group_name')->groupBy('group_name')->get();
@endphp
<form id="role-permission-form" method="post" action="" enctype="multipart/form-data">
    <div class="modal fade" id="role-permission-modal" tabindex="-1" aria-labelledby="rolePermissionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rolePermissionModalLabel">Role Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="permission-all">
                        <label class="form-check-label" for="permission-all">Permission All </label>
                    </div>

                    <hr>

                    <div class="row" id="permission-group">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
