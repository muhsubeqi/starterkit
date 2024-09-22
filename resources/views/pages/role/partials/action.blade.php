<td class="text-center fs-sm">
    @can('role.permission')
        <a class="btn btn-sm btn-alt-info" data-id="{{ $row->id }}" data-role-permissions="{{ $rolePermissions }}"
            data-bs-toggle="modal" data-bs-target="#role-permission-modal" data-bs-toggle="tooltip" aria-label="Role Permission"
            data-bs-original-title="Role Permission">
            <i class="fas fa-key"></i>
        </a>
    @endcan
    @can('role.edit')
        <a class="btn btn-sm btn-alt-secondary" data-id="{{ $row->id }}" data-name="{{ $row->name }}"
            data-bs-toggle="modal" data-bs-target="#form-modal" data-bs-toggle="tooltip" aria-label="Edit"
            data-bs-original-title="Edit">
            <i class="fa fa-fw fa-pen"></i>
        </a>
    @endcan
    @can('role.delete')
        <a class="btn btn-sm btn-alt-danger btn-delete" data-bs-toggle="tooltip" aria-label="Delete"
            data-id="{{ $row->id }}" data-bs-original-title="Delete">
            <i class="fa fa-fw fa-times text-danger"></i>
        </a>
    @endcan
</td>
