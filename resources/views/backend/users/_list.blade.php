<table class="table table-striped " style="width:100%">
    <thead class="bg-info">
    <tr>
        <th>#</th>
        <th>Avatar</th>
        <th>Username</th>
        <th>Email</th>
        <th>Created By</th>
        <th>Created At</th>
        <th>Actions</th>
        <th class="text-right" style="width: 1%"><input type="checkbox" class="check_all"></th>
    </tr>
    </thead>
    <tbody id="ajaxContent">
    @forelse($dataset as $data)
    <tr>
        <td>{{ $dataset->firstItem() + $loop->index }}</td>
        <td><img src="{{ asset($data->image) }}" alt="{{ $data->title }}" width="100%"></td>
        <td class="text-wrap algin-items-center">{{ $data->username }}</td>
        <td>{{ $data->email }}</td>
        <td>{{ Auth::user()->name ?? ''}}</td>
        <td>{{ $data->created_at->diffForHumans() }}</td>
        <td>
            <a href="{{ route(app()->master->routePrefix . 'user.edit', Crypt::encrypt($data->id)) }}" class="btn btn-primary btn-sm px-1 py-1"><span class="icon-wrench"></span></a>
            <a href="{{ route(app()->master->routePrefix . 'user.show', Crypt::encrypt($data->id)) }}" class="btn btn-success btn-sm px-1 py-1"><span class="icon-screen-desktop"></span></a>
            <a href="{{ route(app()->master->routePrefix . 'user.access', Crypt::encrypt($data->_key)) }}" class="btn btn-info btn-sm px-1 py-1"><span class="icon-key"></span></a>
        </td>
        <td><input type="checkbox" name="data[]" value="{{ $data->_key }}" class="check_item"></td>
    </tr>
    @empty
    <tr class="text-center"><td colspan="8">No record found!</td></tr>
    @endforelse
    </tbody>
</table>