<x-admin-layout>
  
  <x-breadcrumbs :title="$page_title">
    <a href="{{ route(app()->master->routePrefix . 'dashboard') }}" class="text-sm text-dark text-decoration-none py-0 ">Home > </a>
    <a href="{{ route(app()->master->routePrefix . 'user.index') }}" class="text-sm text-dark text-decoration-none py-0"> User > </a>
    <a > Edit</a>
  </x-breadcrumbs>

  <x-form-error-message-component :errors="$errors" />

<div class="content-wrapper p-4">
  <form action="{{ route(app()->master->routePrefix . 'user.update', Crypt::encrypt($data->id)) }}" method="POST" class="forms-sample" enctype="multipart/form-data">
      @csrf
      @method('PUT')
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
                <div class="form-group">
                    <label for="name" class="text-dark"><strong>Name</strong></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Full Name..." value="{{ $data->name }}" required>
                </div>
                <div class="form-group">
                    <label for="username" class="text-dark"><strong>Username</strong></label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username..." value="{{ $data->username }}" required>
                </div>
                <div class="form-group">
                    <label for="email" class="text-dark"><strong>Email</strong></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email..." value="{{ $data->email }}" required>
                </div>
                <div class="form-group">
                    <label for="locale" class="text-dark"><strong>Language</strong></label>
                    <select name="locale" id="locale" class="form-control select2search">
                      <option value="en">English</option>
                      <option value="bn">Bangla</option>
                    </select>
                </div>
                <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-warning">Reset</button>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <div>
                <h5 class="m-0 text-muted"><span class="fs-5 text-dark"><span class="mdi mdi-file-document-outline"></span>User Avatar</span></h5>
              </div>
            </div>
            <div class="card-content mt-4">
                <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <img src="{{ asset($data->avatar) }}" width="100%" alt="">
                      </div>
                      <div class="col-md-12">
                        <input type="file" name="avatar" id="avatar" class="form-control mt-5" value="{{ $data->avatar }}">
                      </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      </form>
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

