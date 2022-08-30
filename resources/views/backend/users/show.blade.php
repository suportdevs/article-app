<x-admin-layout>

  
  <x-breadcrumbs :title="$page_title">
    <a href="{{ route(app()->master->routePrefix . 'dashboard') }}" class="text-sm text-dark text-decoration-none py-0 ">Home > </a>
    <a href="{{ route(app()->master->routePrefix . 'post.index') }}" class="text-sm text-dark text-decoration-none py-0 "> Post > </a>
    <a > Create</a>
  </x-breadcrumbs>

    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
              <div>
                <h5 class="m-0 text-muted"><span class="fs-5 text-dark"><span class="mdi mdi-file-document-outline"></span> Post</span> Create Table List</h5>
                <p class="m-0">Post Management Database</p>
              </div>
            </div>
            <div class="card-content mt-4">
                <div class="featured-image">
                  <img src="{{ asset($data->image) }}" alt="{{ $data->title }}" style="width: 100%">
                </div>
                <div class="title">
                  <h3>{{ $data->title }}</h3>
                </div>
                <div class="intro">
                  <p>{{ $data->intro }}</p>
                </div>
                <div class="description">
                  <p>{!! $data->description !!}</p>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-admin-layout>

