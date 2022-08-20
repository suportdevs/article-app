<x-admin-layout>
  
  <x-breadcrumbs :title="$page_title">
    <a href="{{ route(app()->master->routePrefix . 'dashboard') }}" class="text-sm text-dark text-decoration-none py-0 ">Home > </a>
    <a href="{{ route(app()->master->routePrefix . 'post.index') }}" class="text-sm text-dark text-decoration-none py-0 "> Category > </a>
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
                <h5 class="m-0 text-muted"><span class="fs-5 text-dark"><span class="mdi mdi-file-document-outline"></span> Category</span> Create Table List</h5>
                <p class="m-0">Category Management Database</p>
              </div>
            </div>
            <div class="card-content mt-4">
                <form action="{{ route(app()->master->routePrefix . 'post.store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="text-dark">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Post title..." required>
                    </div>
                    <div class="form-group">
                        <label for="intro" class="text-dark">Intro</label>
                        <textarea name="intro" id="intro" cols="30" rows="3" class="form-control" placeholder="Write something..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description" class="text-dark">Description</label>
                        <textarea name="description" id="editor" cols="80" rows="3" class="form-control" placeholder="Write something..." style="min-height: 150px;" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image" class="text-dark">Fetured Image</label>
                        <input type="file" name="image" id="image" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-4">
                          <label for="category_id" class="text-dark">Category</label>
                          <select name="category_id" id="category_id" class="form-control select2search" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="type" class="text-dark">Type</label>
                          <select name="type" id="type" class="form-control select2search" required>
                            <option value="Article">Article</option>
                            <option value="News">News</option>
                            <option value="Videos">Videos</option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="is_featured" class="text-dark">Is Fetured</label>
                          <select name="is_featured" id="is_featured" class="form-control select2search">
                            <option value="Featured">Yes</option>
                            <option value="Non-Featured">No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-8">
                          <label for="tag_id" class="text-dark">Tags</label>
                          <select name="tag_id[]" id="tag_id" class="form-control select2search tags" multiple="multiple" required>
                            <option >Select Tags</option>
                            @foreach($tags as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="status" class="text-dark">Status</label>
                          <select name="status" id="status" class="form-control select2search">
                            <option value="Published">Publish</option>
                            <option value="Pending">Pending</option>
                            <option value="Drafted">Draft</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary bg-primary">Submit</button>
                </form>
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
                uploadUrl: "{{ route('admin.ckeditor.image.upload').'?_token='.csrf_token() }}"
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

