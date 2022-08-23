<x-admin-layout>

  
  <x-breadcrumbs :title="$page_title">
    <a href="{{ route(app()->master->routePrefix . 'dashboard') }}" class="text-sm text-dark text-decoration-none py-0 ">Home > </a>
    <a href="{{ route(app()->master->routePrefix . 'subscriber.index') }}" class="text-sm text-dark text-decoration-none py-0 "> Subscriber > </a>
    <a > Create</a>
  </x-breadcrumbs>

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
                <h5 class="m-0 text-muted"><span class="fs-5 text-dark"><span class="mdi mdi-file-document-outline"></span> Subscriber</span> Create Table List</h5>
                <p class="m-0">Subscriber Management Database</p>
              </div>
            </div>
            <div class="card-content mt-4">
                <form action="{{ route(app()->master->routePrefix . 'subscriber.store') }}" method="POST" class="forms-sample">
                    @csrf
                <div class="form-group">
                    <label for="email" class="text-dark">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                    <button type="submit" class="btn btn-primary bg-primary">Submit</button>
                    <button type="reset" id="clear" class="btn btn-warning">Clear</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-admin-layout>

