<x-admin-layout>

  
  <x-breadcrumbs :title="$page_title">
    <a href="{{ route('admin.dashboard') }}" class="text-sm text-dark text-decoration-none py-0 ">Home > </a>
    <a href="{{ route('admin.category.index') }}" class="text-sm text-dark text-decoration-none py-0 "> Category > </a>
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
                <form action="{{ route('admin.category.store') }}" method="POST" class="forms-sample">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="text-dark">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Post title..." required>
                    </div>
                    <div class="form-group">
                        <label for="intro" class="text-dark">Intro</label>
                        <textarea name="intro" id="intro" cols="30" rows="3" class="form-control" placeholder="Write something..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description" class="text-dark">Description</label>
                        <textarea name="description" id="editor" cols="30" rows="3" class="form-control" placeholder="Write something..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image" class="text-dark">Fetured Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-4">
                          <label for="category_id" class="text-dark">Category</label>
                          <select name="category_id" id="category_id" class="form-control select2search">
                            <option value="">Select Category</option>
                            @foreach($categories as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="type" class="text-dark">Fetured Image</label>
                          <select name="type" id="type" class="form-control select2search">
                            <option value="Article">Article</option>
                            <option value="News">News</option>
                            <option value="Videos">Videos</option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="is_featured" class="text-dark">Is Fetured</label>
                          <select name="is_featured" id="is_featured" class="form-control select2search">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-8">
                          <label for="tag_id" class="text-dark">Tags</label>
                          <select name="tag_id" id="tag_id" class="form-control select2search">
                            <option value="">Select Tags</option>
                            @foreach($tags as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="status" class="text-dark">Status</label>
                          <select name="status" id="status" class="form-control select2search">
                            <option value="Publish">Publish</option>
                            <option value="Pending">Pending</option>
                            <option value="Draft">Draft</option>
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
      class MyUploadAdapter {
          constructor( loader ) {
              // The file loader instance to use during the upload.
              this.loader = loader;
          }

          // Starts the upload process.
          upload() {
              return this.loader.file
                  .then( file => new Promise( ( resolve, reject ) => {
                      this._initRequest();
                      this._initListeners( resolve, reject, file );
                      this._sendRequest( file );
                  } ) );
          }

          // Aborts the upload process.
          abort() {
              if ( this.xhr ) {
                  this.xhr.abort();
              }
          }

          // Initializes the XMLHttpRequest object using the URL passed to the constructor.
          _initRequest() {
              const xhr = this.xhr = new XMLHttpRequest();

              // Note that your request may look different. It is up to you and your editor
              // integration to choose the right communication channel. This example uses
              // a POST request with JSON as a data structure but your configuration
              // could be different.
              xhr.open( 'POST', '{{ route("admin.post_image.store") }}', true );
              xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}')
              xhr.responseType = 'json';
          }
          // Initializes XMLHttpRequest listeners.
          _initListeners( resolve, reject, file ) {
              const xhr = this.xhr;
              const loader = this.loader;
              const genericErrorText = `Couldn't upload file: ${ file.name }.`;

              xhr.addEventListener( 'error', () => reject( genericErrorText ) );
              xhr.addEventListener( 'abort', () => reject() );
              xhr.addEventListener( 'load', () => {
                  const response = xhr.response;

                  // This example assumes the XHR server's "response" object will come with
                  // an "error" which has its own "message" that can be passed to reject()
                  // in the upload promise.
                  //
                  // Your integration may handle upload errors in a different way so make sure
                  // it is done properly. The reject() function must be called when the upload fails.
                  if ( !response || response.error ) {
                      return reject( response && response.error ? response.error.message : genericErrorText );
                  }

                  // If the upload is successful, resolve the upload promise with an object containing
                  // at least the "default" URL, pointing to the image on the server.
                  // This URL will be used to display the image in the content. Learn more in the
                  // UploadAdapter#upload documentation.
                  resolve( {
                      default: response.url
                  } );
              } );

              // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
              // properties which are used e.g. to display the upload progress bar in the editor
              // user interface.
              if ( xhr.upload ) {
                  xhr.upload.addEventListener( 'progress', evt => {
                      if ( evt.lengthComputable ) {
                          loader.uploadTotal = evt.total;
                          loader.uploaded = evt.loaded;
                      }
                  } );
              }
          }
          // Prepares the data and sends the request.
          _sendRequest( file ) {
              // Prepare the form data.
              const data = new FormData();

              data.append( 'upload', file );

              // Important note: This is the right place to implement security mechanisms
              // like authentication and CSRF protection. For instance, you can use
              // XMLHttpRequest.setRequestHeader() to set the request headers containing
              // the CSRF token generated earlier by your application.

              // Send the request.
              this.xhr.send( data );
          }
      }

        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    @endpush
</x-admin-layout>

