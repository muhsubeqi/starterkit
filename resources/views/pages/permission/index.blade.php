@extends('layouts.backend')
@push('styles')
@vite([
'resources/sass/plugins/datatables.scss',
])
@endpush
@push('scripts')
@vite([
'resources/js/plugins/datatables-init.js',
'resources/js/pages/permission.js',
])
<script>
    const COLUMNS = @json($columns)
</script>
@endpush
@section('content')
<!-- Page Content -->
<div class="content">
    <div class="block block-rounded" id="block-permission">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Permission <small>List</small>
            </h3>
            <div class="block-options">
                <button type="button" class="btn-block-option" data-toggle="block-option" id="btn-refresh">
                    <i class="si si-refresh"></i>
                </button>
                <button type="button" class="btn-block-option" data-toggle="block-option"
                    data-action="content_toggle"></button>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter fs-sm w-100" id="permission-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 20px;">#</th>
                        <th>Name</th>
                        <th>Group Name</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection