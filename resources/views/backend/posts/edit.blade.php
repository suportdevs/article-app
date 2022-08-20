<x-admin-layout>
  
  <x-breadcrumbs :title="$page_title">
    <a href="{{ route(app()->master->routePrefix . 'dashboard') }}" class="text-sm text-dark text-decoration-none py-0 ">Home > </a>
    <a href="{{ route(app()->routePrefix . 'post.index') }}" class="text-sm text-dark text-decoration-none py-0 "> Post > </a>
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
            <div class="d-flex justify-content-between align-items-center mb-4">
              <div>
                <h5 class="m-0 text-muted"><span class="fs-5 text-dark"><span class="mdi mdi-file-document-outline"></span> {{ $page_title }}</span> Edit Table List</h5>
                <p class="m-0">{{ $page_title }} Management Database</p>
              </div>
            </div>
            <div class="card-content mt-4">
            <form action="{{ route(app()->routePrefix . 'post.update', $data->id) }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title" class="text-dark">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Post title..." value="{{ $data->title }}" required>
                    </div>
                    <div class="form-group">
                        <label for="intro" class="text-dark">Intro</label>
                        <textarea name="intro" id="intro" cols="30" rows="3" class="form-control" placeholder="Write something..." value="{{ $data->intro }}">{{ $data->intro }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description" class="text-dark">Description</label>
                        <textarea name="description" id="editor" cols="80" rows="3" class="form-control" placeholder="Write something..." value="{{ $data->description }}">{!! $data->description !!}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="row">
                          <div class="col-md-8">
                            <label for="image" class="text-dark">Fetured Image</label>
                            <input type="file" name="image" id="image" class="form-control" value="{{ $data->image }}">
                          </div>
                          <div class="col-md-4">
                            <img src="{{ asset($data->image) }}" width="100px" alt="">
                          </div>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-4">
                          <label for="category_id" class="text-dark">Category</label>
                          <select name="category_id" id="category_id" class="form-control select2search">
                            <option value="">Select Category</option>
                            @foreach($categories as $id => $name)
                            <option value="{{ $id }}" {{ $id == $data->category_id ? 'selected' : ''}}>{{ $name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="type" class="text-dark">Type</label>
                          <select name="type" id="type" class="form-control select2search">
                            @foreach(articleTypes() as $type)
                            <option value="{{ $type }}" {{ $data->type == $type ? 'selected' : ''}}>{{ $type}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="is_featured" class="text-dark">Is Fetured</label>
                          <select name="is_featured" id="is_featured" class="form-control select2search">
                            <option value="Featured" {{ $data->is_featured == "Yes" ? 'selected' : ''}}>Yes</option>
                            <option value="Non-Featured" {{ $data->is_featured == "No" ? 'selected' : ''}}>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-8">
                          <label for="tag_id" class="text-dark">Tags</label>
                          <select name="tag_id[]" id="tag_id" class="form-control select2search tags" multiple="multiple">
                            <option >Select Tags</option>
                              @foreach($tags as $id => $name)
                                <option value="{{ $id }}" {{ in_array($id, json_decode($data->tag_id)) == $id ? 'selected' : ''}}>{{ $name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="status" class="text-dark">Status</label>
                          <select name="status" id="status" class="form-control select2search">
                            @foreach(articleStatus() as $status)
                            <option value="{{ $status }}"{{ $data->status == $status ? 'selected' : ''}}>{{ $status}}</option>
                            @endforeach
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

