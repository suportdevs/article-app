<x-admin-layout>

<div class="main-panel">
  <div class="content-wrapper p-4">
  
  <x-breadcrumbs :title="$page_title">
    <a href="{{ route('admin.dashboard') }}" class="text-sm text-dark text-decoration-none py-0 ">Home > </a>
    <a href="{{ route('admin.tags.index') }}" class="text-sm text-dark text-decoration-none py-0 "> Tags > </a>
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
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h4 class="text-black m-0"><b>Tags</b> Data Table List</h4>
                <span class="text-sm">Tags Management Database</span>
              </div>
            </div>
            <div class="card-content mt-4">
                <form action="{{ route('admin.tags.store') }}" method="POST" class="forms-sample">
                    @csrf
                <div class="form-group">
                    <label for="name" class="text-dark">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <button type="submit" class="btn btn-primary bg-primary">Submit</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
  <footer class="footer">
    <div class="footer-inner-wraper">
      <div class="d-sm-flex justify-content-center justify-content-sm-between py-2">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com </a>2021</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best <a href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard </a> templates</span>
      </div>
    </div>
  </footer>
  <!-- partial -->
</div>
<script>
  function toastrClick(){
    toastr.options = { "closeButton" : true }
    toastr.success("hi im toastr");
  }
</script>
</x-admin-layout>

