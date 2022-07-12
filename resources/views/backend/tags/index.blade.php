<x-admin-layout>
<div class="main-panel">
  <div class="content-wrapper">
  
  <x-breadcrumbs :title="$page_title">
    <a href="{{ route('admin.dashboard') }}" class="text-sm text-dark text-decoration-none py-0 ">Home > </a>
    <a class="text-sm text-dark text-decoration-none py-0 "> Tags </a>
  </x-breadcrumbs>

    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-block text-center">
              <div>
                <a href="{{ route('admin.tags.create') }}" class="btn btn-success btn-sm px-1 py-1"><span class="mdi mdi-plus"></span> New</a>
              </div>
            </div>
            <div class="d-block">
              <div class="row">
                <form action="{{ route('admin.tags.index') }}" method="POST" id="searchForm">
                  @csrf
                  <div class="input-group mb-3">
                    <div class="col-md-1">
                      <select name="item_count" id="item_count" class="form-control">
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <input type="text" name="tag_name" placeholder="Tag Name" class="form-control">
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-primary">Search</button>
                      <button type="rest" class="btn btn-warning">Clear</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div id="ajaxContent-wraper">
              @include('backend.tags._list')
            </div>
          </div>
          <div class="text-center mx-auto">
          {{ $dataset->links() }}
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
</x-admin-layout>