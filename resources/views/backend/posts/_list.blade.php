<table class="table table-striped " style="width:100%">
    <thead class="bg-info">
    <tr>
        <th>#</th>
        <th>Image</th>
        <th>Title</th>
        <th>Intro</th>
        <th>Category</th>
        <th>Created By</th>
        <th>Created At</th>
        <th>Actions</th>
        <th style="width:50px"><input type="checkbox" class="check_all"></th>
    </tr>
    </thead>
    <tbody id="ajaxContent">
    @forelse($dataset as $data)
    <tr>
        <td>{{ $dataset->firstItem() + $loop->index }}</td>
        <td><img src="{{ asset($data->image) }}" alt="{{ $data->title }}" width="100%"></td>
        <td class="text-wrap algin-items-center">
            <span>{{ Str::words($data->title, 15, '...') }}</span>
            <span class="badge p-1 
            {{ $data->status == 'Published' ? 'bg-success' : '' }} {{ $data->status == 'Pending' ? 'bg-primary' : ''}} {{ $data->status == 'Drafted' ? 'bg-warning' : '' }}
                ">{{ $data->status }}</span>
            <span class="badge p-1 
            {{ $data->is_featured == 'Featured' ? 'badge-primary' : 'bg-warning' }}">{{ $data->is_featured }}</span>
            <!-- <span class="badge p-1 
            {{ $data->status == 'Publish' ? 'badge-primary' : 'bg-warning' }}">{{ $data->is_featured }}</span> -->
        </td>
        <td class="text-wrap">{{ Str::words($data->intro, 20, '...')}}</td>
        <td>{{ $data->category->name ?? '' }}</td>
        <td>{{ Auth::user()->name ?? ''}}</td>
        <td>{{ $data->created_at->diffForHumans() }}</td>
        <td>
            <a href="{{ route(app()->master->routePrefix . 'post.edit', Crypt::encrypt($data->id)) }}" class="btn btn-primary btn-sm px-1 py-1"><span class="mdi mdi-wrench"></span></a>
            <a href="{{ route(app()->master->routePrefix . 'post.show', Crypt::encrypt($data->id)) }}" class="btn btn-success btn-sm px-1 py-1"><span class="mdi mdi-monitor"></span></a>
        </td>
        <td><input type="checkbox" name="data[]" value="{{ $data->_key }}" class="check_item"></td>
    </tr>
    @empty
    <tr class="text-center"><td colspan="9">No record found!</td></tr>
    @endforelse
    </tbody>
</table>