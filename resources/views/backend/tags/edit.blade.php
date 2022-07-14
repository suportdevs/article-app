<x-admin-layout>

  
  <x-breadcrumbs :title="$page_title">
    <a href="{{ route('admin.dashboard') }}" class="text-sm text-dark text-decoration-none py-0 ">Home > </a>
    <a href="{{ route('admin.tags.index') }}" class="text-sm text-dark text-decoration-none py-0 "> Tags > </a>
    <a > Edit</a>
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
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h4 class="text-black m-0"><b>Tags</b> Edit Table List</h4>
                <span class="text-sm">Tags Management Database</span>
              </div>
            </div>
            <div class="card-content mt-4">
                <form action="{{ route('admin.tags.update', $data->id ) }}" method="POST" class="forms-sample">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="text-dark">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary bg-primary">Submit</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-admin-layout>

