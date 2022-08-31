<x-admin-layout>
  
  <x-breadcrumbs :title="$page_title">
    <a href="{{ route(app()->master->routePrefix . 'dashboard') }}" class="text-sm text-dark text-decoration-none py-0 ">Home > </a>
    <a class="text-sm text-dark text-decoration-none py-0 "> Users </a>
  </x-breadcrumbs>

    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body p-0">
            <div class="card-title bg-info d-flex justify-content-between align-items-center m-0">
              <div class="d-flex align-items-center">
                <label for="module" class="ms-4">
                  <input type="checkbox">
                  permission module
                </label>
                <!-- <h5 class="title-heading text-white m-0">   Permissiont module</h5> -->
              </div>
            <button class="btn btn-primary " onclick="toggle_panel_body(this, 'wrapper')"><span class="icon-arrow-up"></span></button>
            </div>
            <div class="wrapper body align-items-center">
              
            <li class="list-group-item" style="float: left;width: 25%;"><label for="access-item"><input type="checkbox" name="access" id="access-item"> <span>Permission name</span></label></li>
            </div>
          </div>
        </div>
      </div>
    </div>
    @push('scripts')
    <script>
      function toggle_panel_body(elm, panel) {
        if ($(`.${panel}`).is(":visible")) {
            $(`.${panel}`).slideUp('fast');
            $(elm).css({'transform': 'rotate(180deg)', 'transition': '.5s'});
        } else {
            $(`.${panel}`).slideDown('fast');
            $(elm).css('transform', 'rotate(0deg)');
        }
    }
    </script>
    @endpush
</x-admin-layout>