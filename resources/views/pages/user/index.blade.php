@extends('layouts.backend',['filter' => true])

@push('styles')
@vite([
'resources/sass/plugins/select2.scss',
'resources/sass/plugins/datatables.scss',
])
@endpush
@push('scripts')
<script>
    const COLUMNS = @json($columns);
</script>
@vite([
'resources/js/plugins/datatables-init.js',
'resources/js/plugins/jq-validation-init.js',
'resources/js/plugins/select2-init.js',
'resources/js/plugins/sweetalert2-init.js',
'resources/js/pages/user.js'])
@endpush

@section('content')
<x-hero-section title="User" subtitle="List of all users" :breadcrumbs="[
    ['label' => 'Management', 'url' => 'javascript:void(0)'],
    ['label' => 'User'],
]" />
<!-- Page Content -->
<div class="content">
    <!-- Info -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Plugin Example</h3>
        </div>
        <div class="block-content fs-sm text-muted">
            <p>
                This page showcases how easily you can add a plugin’s JS/CSS assets and init it using custom JS code.
            </p>
        </div>
    </div>
    <!-- END Info -->

    <!-- Dynamic Table Full -->
    <div class="block block-rounded" id="block-user">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                User <small>List</small>
            </h3>
            <div class="block-options">
                @can('user.create')
                <button type="button" class="btn-block-option" data-bs-toggle="modal" data-bs-target="#form-modal">
                    <i class="si si-plus"></i>
                </button>
                <button type="button" class="btn-block-option" data-bs-toggle="modal" data-bs-target="#form-modal">
                    <i class="si si-cloud-upload"></i>
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
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter fs-sm w-100" id="user-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th class="text-start" class="d-none d-sm-table-cell">Image</th>
                        <th>Name</th>
                        <th class="d-none d-sm-table-cell">Email</th>
                        <th class="d-none d-sm-table-cell">Role</th>
                        <th class="d-none d-sm-table-cell">Status</th>
                        @if (Gate::allows('user.edit') || Gate::allows('user.delete'))
                        <th style="width: 10%;">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
@include('pages.user.partials.form')
@section('filter-content')
<x-filter.input-select name="filter-role" label="Role" :options="$roles" />
@endsection
<!-- END Page Content -->
@endsection