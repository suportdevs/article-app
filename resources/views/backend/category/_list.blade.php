<table class="table table-striped " style="width:100%">
    <thead class="bg-info">
    <tr>
        <th>#</th>
        <th> Name </th>
        <th> Slug</th>
        <th> Description</th>
        <th> Created By </th>
        <th> Created At </th>
        <th>Actions</th>
        <th style="width:50px"><input type="checkbox" class="check_all"></th>
    </tr>
    </thead>
    <tbody id="ajaxContent">
    @forelse($dataset as $data)
    <tr>
        <td>{{ $dataset->firstItem() + $loop->index }}</td>
        <td>{{ $data->name }}</td>
        <td>{{ $data->slug }}</td>
        <td class="text-wrap">{{ Str::words($data->description, 10, '...') }}</td>
        <td>{{ Auth::guard("admin")->user()->name ?? ''}}</td>
        <td>{{ $data->created_at->diffForHumans() }}</td>
        <td><a href="{{ route('admin.category.edit', Crypt::encrypt($data->id)) }}" class="btn btn-primary btn-sm px-1 py-1"><span class="mdi mdi-wrench"></span></a></td>
        <td><input type="checkbox" name="data[]" value="{{ $data->_key }}" class="check_item"></td>
    </tr>
    @empty
    <tr class="text-center"><td colspan="8">No record found!</td></tr>
    @endforelse
    </tbody>
</table>