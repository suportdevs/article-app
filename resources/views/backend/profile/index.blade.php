<x-admin-layout>
  
  <x-breadcrumbs :title="$page_title">
    <a href="{{ route(app()->master->routePrefix . 'dashboard') }}" class="text-sm text-dark text-decoration-none py-0 ">Home > </a>
    <a class="text-sm text-dark text-decoration-none py-0 "> Profile </a>
  </x-breadcrumbs>

    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body px-3">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <div>
                <h5 class="m-0 text-muted"><span class="fs-5 text-dark"><span class="icon-user"></span> Profile</span> Data Table List</h5>
                <p class="m-0">User Profile Management Database</p>
              </div>
              <div>
                <a href="{{ route(app()->master->routePrefix . 'users.create') }}" class="btn btn-success btn-sm px-1 py-1"><span class="icon-plus"></span> New</a>
                <button class="btn btn-danger btn-sm px-1 py-1" id="deleteMultiple" disabled><span class="icon-trash"></span> Delete</button>
              </div>
            </div>
            <div class="d-block">
            </div>
          </div>
          <div class="text-center mx-auto">
          {{ $dataset->links() }}
          </div>
        </div>
      </div>
    </div>
</x-admin-layout>