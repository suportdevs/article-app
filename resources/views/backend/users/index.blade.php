<x-admin-layout>
  
  <x-breadcrumbs :title="$page_title">
    <a href="{{ route(app()->master->routePrefix . 'dashboard') }}" class="text-sm text-dark text-decoration-none py-0 ">Home > </a>
    <a class="text-sm text-dark text-decoration-none py-0 "> Users </a>
  </x-breadcrumbs>

  <div class="content-wrapper p-4">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <div>
                <h5 class="m-0 text-muted"><span class="fs-5 text-dark"><span class="icon-people"></span> {{ $page_title }}</span> Data Table</h5>
                <p class="m-0">Users Management Database</p>
              </div>
              <div>
                <a href="{{ route(app()->master->routePrefix . 'user.create') }}" class="btn btn-success btn-sm px-1 py-1"><span class="icon-plus"></span> New</a>
                <button class="btn btn-danger btn-sm px-1 py-1" id="deleteMultiple" disabled><span class="icon-trash"></span> Delete</button>
              </div>
            </div>
            <div class="d-block">
              <div class="row">
                <form action="{{ route(app()->master->routePrefix.'user.index') }}" method="GET" id="searchForm">
                  @csrf
                  <div class="input-group mb-3">
                    <div class="col-md-1" style="width: 50px;">
                      <select name="item_count" id="item_count" class="form-control">
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <input type="text" name="user_name" placeholder="Username, Email" class="form-control">
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-primary">Search</button>
                      <button type="rest" id="clear" class="btn btn-warning">Clear</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <form action="{{ route(app()->master->routePrefix . 'users.delete') }}" method="POST" id="formList">
              <div id="ajaxContent-wraper" class="table-responsive-sm">
                @include('backend.users._list')
              </div>
            </form>
          </div>
          <div class="text-center mx-auto">
          {{ $dataset->links() }}
          </div>
        </div>
      </div>
    </div>
</x-admin-layout>