<table>
    <thead>
        <tr>
            <th>Order Id</th>
            <th>Base subTotal</th>
            <th>Base Grand Total</th>
            <th>Order Time</th>
            <th>PickedUp/Delivery time</th>
            <th>PickedUp/Delivery Location</th>
            <th>Status</th>
            <th>Shipping Method</th>
            <th>Name</th>
            <th>customer First Name</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->total_amount }}</td>
                <td>{{ $order->grand_total }}</td>
                <td>{{ $order->created_at->format('d-m-Y H:i:s A') }}</td>
                <td>{{ date('d-m-Y', strtotime($order->date)) . ' ' . $order->time }}</td>
                <td>{{ $order->city }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->shipping_method }}</td>
                <td>{{ $order->first_name . ' ' . $order->last_name }}</td>
                <td>{{ $order->first_name }}</td>
                <td>{{ date('d-m-Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
