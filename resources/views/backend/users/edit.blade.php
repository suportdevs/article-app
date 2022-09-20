<x-admin-layout>
  
  <x-breadcrumbs :title="$page_title">
    <a href="{{ route(app()->master->routePrefix . 'dashboard') }}" class="text-sm text-dark text-decoration-none py-0 ">Home > </a>
    <a href="{{ route(app()->master->routePrefix . 'user.index') }}" class="text-sm text-dark text-decoration-none py-0"> User > </a>
    <a > Edit</a>
  </x-breadcrumbs>
  
<div class="content-wrapper p-4">
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
</div>
<div class="content-wrapper p-4">
    <div class="row">
      <div class="col-lg-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body p-4">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
              <div>
                <h5 class="m-0 text-muted"><span class="fs-5 text-dark"><span class="mdi mdi-file-document-outline"></span> {{ $page_title }}</span> Table List</h5>
                <p class="m-0">{{ $page_title }} Management Database</p>
              </div>
            </div>
            <div class="card-content mt-4">
            <form action="{{ route(app()->master->routePrefix . 'profile.update', $data->id) }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="text-dark">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name..." value="{{ $data->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="username" class="text-dark">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username..." value="{{ $data->username }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-dark">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email..." value="{{ $data->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="locale" class="text-dark">Language</label>
                        <select name="locale" id="locale" class="form-control select2search">
                          <option value="en">English</option>
                          <option value="bn">Bangla</option>
                        </select>
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
      <div class="col-lg-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body p-4">
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
                <h5 class="m-0 text-muted"><span class="fs-5 text-dark"><span class="mdi mdi-file-document-outline"></span>User Avatar</span></h5>
              </div>
            </div>
            <div class="card-content mt-4">
                <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <img src="{{ asset($data->image) }}" width="100px" alt="">
                      </div>
                      <div class="col-md-12">
                        <input type="file" name="image" id="image" class="form-control" value="{{ $data->image }}">
                      </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    @push('scripts')
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
              ckfinder: {
                uploadUrl: "{{ route(app()->master->routePrefix . 'ckeditor.image.upload').'?_token='.csrf_token() }}"
              }
            } )
            .then((editor) => {
              console.log(editor);
            })
            .catch( error => {
                console.error( error );
            } );
    </script>
    @endpush
</x-admin-layout>

