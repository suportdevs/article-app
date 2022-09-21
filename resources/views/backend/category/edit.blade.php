<x-admin-layout>

  
  <x-breadcrumbs :title="$page_title">
    <a href="{{ route(app()->master->routePrefix . 'dashboard') }}" class="text-sm text-dark text-decoration-none py-0 ">Home > </a>
    <a href="{{ route(app()->master->routePrefix . 'category.index') }}" class="text-sm text-dark text-decoration-none py-0 "> Category > </a>
    <a > Edit</a>
  </x-breadcrumbs>

  <x-form-error-message-component :errors="$errors" />

  <div class="content-wrapper p-4">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <div class="d-flex justify-content-between align-items-center mb-4">
              <div>
                <h5 class="m-0 text-muted"><span class="fs-5 text-dark"><span class="icon-organization line-icon"></span> {{ $page_title }}</span> Table</h5>
                <p class="m-0">Category Management Database</p>
              </div>
            </div>
            <div class="card-content mt-4">
                <form action="{{ route(app()->master->routePrefix . 'category.update', Crypt::encrypt($data->id) ) }}" method="POST" class="forms-sample">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="text-dark"><strong>Name</strong></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description" class="text-dark"><strong>Description</strong></label>
                        <textarea name="description" id="description" cols="30" rows="3" value="{{ $data->description }}" class="form-control">{{ $data->description }}</textarea>
                    </div>
                    <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-admin-layout>

