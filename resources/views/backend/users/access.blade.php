<x-admin-layout>
  
  <x-breadcrumbs :title="$page_title">
    <a href="{{ route(app()->master->routePrefix . 'dashboard') }}" class="text-sm text-dark text-decoration-none py-0 ">Home > </a>
    <a class="text-sm text-dark text-decoration-none py-0 "> Users </a>
  </x-breadcrumbs>

    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body p-0">
            <div class="card-title bg-info d-flex justify-content-between align-items-center m-0 p-3">
              <h4 class="m-0" >Access Control Management For <strong>{{ $user->name }}</strong> {{ $user->email }} permission</h4>
                <label for="check_all" class="text-sm">
                  <input type="checkbox" class="check_all" id="check_all">
                  Select All
                </label>
            </div>
          </div>
        </div>
      </div>
      <form action="{{ route(app()->master->routePrefix .'user.access.store', Crypt::encrypt($user->id)) }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">
      @foreach(permission_module() as $moduleKey => $moduleName)
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body p-0">
            <div class="card-title bg-info d-flex justify-content-between align-items-center m-0">
              <div class="d-flex align-items-center">
                <label for="{{ $moduleKey }}" class="ms-3">
                  <input type="checkbox" class="check_item module_heading" name="access[{{ $moduleKey }}]" id="{{ $moduleKey }}" data-rel="{{ $moduleKey }}" value="{{ $moduleName }}" {{ array_key_exists($moduleKey, $permission) ? 'checked' : ''}}>
                  {{ $moduleName }}
                </label>
              </div>
            <a class="btn btn-primary " onclick="toggle_panel_body(this, '{{ $moduleKey }}')"><span class="icon-arrow-up"></span></a>
            </div>
            <div class="body align-items-center {{ $moduleKey }} ">
              @foreach($moduleKey() as $key => $value)
            <li class="list-group-item" style="float: left;width: 25%;"><label for="{{ $key }}"><input type="checkbox" name="access[{{ $key }}]" value="{{ $value }}" id="{{ $key }}" {{ array_key_exists($key, $permission) ? ' checked' : '' }} class="check_item module_heading"> <span>{{ $value }}</span></label></li>
            @endforeach
            </div>
          </div>
        </div>
      </div>
      @endforeach
      <div class="col-md-12 text-center"><button class="btn btn-primary">Submit</button></div>
      </form>
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
      $(document).ready(function() {
        $(document).on("change", ".module_heading", function () {
            var _div = $(this).attr('data-rel');
            if (this.checked) {
                $("." + _div + " .check_item").prop('checked', true);
            } else {
                $("." + _div + " .check_item").prop('checked', false);
            }
        });
      })
    </script>
    @endpush
</x-admin-layout>