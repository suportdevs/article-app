<x-admin-layout>

  
  <x-breadcrumbs :title="$page_title">
    <a href="{{ route(app()->master->routePrefix . 'dashboard') }}" class="text-sm text-dark text-decoration-none py-0 ">Home > </a>
    <a href="{{ route(app()->master->routePrefix . 'tags.index') }}" class="text-sm text-dark text-decoration-none py-0 "> Tags > </a>
    <a > Edit</a>
  </x-breadcrumbs>

  <x-form-error-message-component :errors="$errors" />

  <div class="content-wrapper p-4">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <div>
                <h5 class="m-0 text-muted"><span class="fs-5 text-dark"><span class="icon-tag line-icon"></span> {{ $page_title }}</span> Table List</h5>
                <p class="m-0">Tags Management Database</p>
              </div>
            </div>
            <div class="card-content mt-4">
                <form action="{{ route(app()->master->routePrefix . 'tags.update', Crypt::encrypt($data->id) ) }}" method="POST" class="forms-sample">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="text-dark"><strong>Name</strong></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}" required>
                    </div>
                    <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-admin-layout>

