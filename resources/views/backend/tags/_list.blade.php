<table class="table table-striped">
    <thead>
    <tr>
        <th> Name </th>
        <th> Slug</th>
        <th> Created By </th>
        <th> Created At </th>
        <th>Actions</th>
        <th><input type="checkbox" class="check_all"></th>
    </tr>
    </thead>
    <tbody id="ajaxContent">
    @forelse($dataset as $data)
    <tr>
        <td>{{ $data->name }}</td>
        <td>{{ $data->slug }}</td>
        <td>{{ Auth::guard("admin")->user()->name ?? ''}}</td>
        <td>{{ $data->created_at->diffForHumans() }}</td>
        <td></td>
        <td><input type="checkbox" class="check_item"></td>
    </tr>
    @empty
    <tr conspan="6" class="text-center">No record found</tr>
    @endforelse
    </tbody>
</table>