@if ($errors->any())
<div class="content-wrapper p-4 pb-0">
  <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
    <ul class="m-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
</div>
@endif