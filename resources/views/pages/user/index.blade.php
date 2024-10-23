@extends('layouts.backend',['filter' => true])

@section('css')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('js')

<!-- Page JS Plugins -->
<script src="{{ asset('js/plugins/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
<script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Page JS Code -->
<script>
    const COLUMNS = @json($columns);
</script>
@vite(['resources/js/pages/user.js'])
@endsection

@section('content')
<x-hero-section
    title="User"
    subtitle="List of all users"
    :breadcrumbs="[
    ['label' => 'Management', 'url' => 'javascript:void(0)'],
    ['label' => 'User'],
]"
/>
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
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full fs-sm w-100"
                id="user-table">
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
