<table>
    <thead>
        <tr>
            <th>Sl No</th>
            <th>Name</th>
            <th>Position</th>
            <th>Slug</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->position }}</td>
                <td>{{ $item->slug }}</td>
                <td>{{ $item->description }}</td>
            </tr>
        @endforeach

    </tbody>
</table>
