<table>
    <thead>
        <tr>
            <th>Sl No</th>
            <th>Subscribed</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($newsletters as $subscribers)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $subscribers->is_subscribed ? 'Subscribed' : 'Unsubscribed' }}</td>
                <td>{{ $subscribers->email }}</td>
            </tr>
        @endforeach

    </tbody>
</table>
