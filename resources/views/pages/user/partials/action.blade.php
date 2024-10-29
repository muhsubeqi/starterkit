<td class="text-center fs-sm">
    @can('user.edit')
    <a class="btn btn-sm btn-alt-secondary" data-id="{{ $row->id }}" data-name="{{ $row->name }}"
        data-image="{{ $row->image }}" data-email="{{ $row->email }}" data-role="{{ $roleId->id }}"
        data-status="{{ $row->status }}" data-bs-toggle="modal" data-bs-target="#form-modal" data-bs-toggle="tooltip"
        aria-label="Edit" data-bs-original-title="Edit">
        <i class="fa fa-fw fa-pen"></i>
    </a>
    @endcan
    @can('user.delete')
    <a class="btn btn-sm btn-alt-danger btn-delete" data-bs-toggle="tooltip" aria-label="Delete"
        data-id="{{ $row->id }}" data-bs-original-title="Delete">
        <i class="fa fa-fw fa-trash text-danger"></i>
    </a>
    @endcan
</td>