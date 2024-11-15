@extends('layouts.backend')
@push('styles')
@vite([
'resources/sass/plugins/select2.scss',
'resources/sass/plugins/datatables.scss',
])
@endpush
@push('scripts')

@vite([
'resources/js/plugins/datatables-init.js',
'resources/js/plugins/jq-validation-init.js',
'resources/js/plugins/select2-init.js',
'resources/js/plugins/sweetalert2-init.js',
'resources/js/pages/role.js'
])
<script>
    const PERMISSIONS = @json($permissions);
    const COLUMNS = @json($columns);
</script>
<!-- Page JS Code -->
@endpush
@section('content')
<x-hero-section title="Role" subtitle="List of all roles" :breadcrumbs="[
        ['label' => 'Dashboard', 'url' => 'javascript:void(0)'],
        ['label' => 'Role'],
    ]" />
<!-- Page Content -->
<div class="content">
    <div class="block block-rounded" id="block-role">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Role <small>List</small>
            </h3>
            <div class="block-options">
                @can('role.create')
                <button type="button" class="btn-block-option" data-bs-toggle="modal" data-bs-target="#form-modal">
                    <i class="si si-plus"></i>
                </button>
                @endcan
                <button type="button" class="btn-block-option" data-toggle="block-option" id="btn-refresh">
                    <i class="si si-refresh"></i>
                </button>
                <button type="button" class="btn-block-option" data-toggle="block-option"
                    data-action="content_toggle"></button>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter fs-sm w-100" id="role-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 20px;">#</th>
                        <th>Name</th>
                        @if (Gate::allows('role.edit') || Gate::allows('role.delete'))
                        <th style="width: 15%;">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('pages.role.partials.form')
@include('pages.role.partials.role-permission')
<!-- END Page Content -->
@endsection