<table class="table table-striped">
    <thead class="bg-info">
    <tr>
        <th>#</th>
        <th> Email </th>
        <th> Created At</th>
        <th class="text-right"><input type="checkbox" class="check_all"></th>
    </tr>
    </thead>
    <tbody id="ajaxContent">
    @forelse($dataset as $data)
    <tr>
        <td>{{ $dataset->firstItem() + $loop->index }}</td>
        <td>{{ $data->email }}</td>
        <td>{{ $data->created_at->diffForHumans() }}</td>
        <td class="text-right"><input type="checkbox" name="data[]" value="{{ $data->_key }}" class="check_item"></td>
    </tr>
    @empty
    <tr class="text-center"><td colspan="7">No record found!</td></tr>
    @endforelse
    </tbody>
</table>