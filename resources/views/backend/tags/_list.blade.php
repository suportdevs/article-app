<table class="table table-striped">
    <thead class="bg-info">
    <tr>
        <th>SR</th>
        <th> Name </th>
        <th> Slug</th>
        <th> Created By </th>
        <th> Created At </th>
        <th>Actions</th>
        <th><input type="checkbox" class="check_all"></th>
    </tr>
    </thead>
    <tbody id="ajaxContent">
        @php
            $s = 1;
        @endphp
    @forelse($dataset as $data)
    <tr>
        <td>{{ $dataset->firstItem() + $loop->index }}</td>
        <td>{{ $data->name }}</td>
        <td>{{ $data->slug }}</td>
        <td>{{ Auth::guard("admin")->user()->name ?? ''}}</td>
        <td>{{ $data->created_at->diffForHumans() }}</td>
        <td><a href="{{ route(app()->master->routePrefix . 'tags.edit', Crypt::encrypt($data->id)) }}" class="btn btn-primary btn-sm px-1 py-1"><span class="mdi mdi-wrench"></span></a></td>
        <td><input type="checkbox" name="data[]" value="{{ $data->_key }}" class="check_item"></td>
    </tr>
    @empty
    <tr class="text-center"><td colspan="7">No record found!</td></tr>
    @endforelse
    </tbody>
</table>