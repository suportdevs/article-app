<div class="content-wrapper bg-light py-2 px-4">
<div class="row d-flex justify-content-between align-items-center">
    <div class="col-md-3">
      <button class="btn fs_7 p-1 btn-primary" onclick="history.back()"><span class="icon-action-undo"></span> Back</button>
      <a href="{{ url('view-clear') }}" class="btn fs_7 p-1 btn-success" onclick="history.back()"><span class="icon-refresh"></span> Refresh</a>
    </div>
    <div class="col-md-6 text-center">
      <h3 class="text-dark m-0">{{ $title }}</h3>
    </div>
    <div class="col-md-3">
      <ul class="m-0" style="text-align: right;">
        {{ $slot }}
      </ul>
    </div>
  </div>
</div>