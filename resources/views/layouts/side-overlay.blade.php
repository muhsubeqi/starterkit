<aside id="side-overlay" class="fs-sm">
    <!-- Side Header -->
    <div class="content-header border-bottom bg-dark">
      <!-- Icon Filter -->
        <i class="fas fa-filter text-white"></i>
      <!-- END Icon Filter -->

      <!-- Filter Info -->
      <div class="ms-2">
        <a class="text-white fw-semibold fs-sm" href="javascript:void(0)">Filter</a>
      </div>
      <!-- END Filter Info -->

      <!-- Close Side Overlay -->
      <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
      <a class="ms-auto btn btn-sm btn-alt-danger" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_close">
        <i class="fa fa-fw fa-times"></i>
      </a>
      <!-- END Close Side Overlay -->
    </div>
    <!-- END Side Header -->

    <!-- Side Content -->
    <div class="content-side">
      @yield('filter-content')
    </div>
    <!-- END Side Content -->
  </aside>
