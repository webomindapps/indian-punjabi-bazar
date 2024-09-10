<x-app-layout>
    <style>
        .bx-show-alt.bx-hide:before {
            content: "\ec0d";
        }

        .text-green,
        p a {
            color: var(--green);
        }

        p a:hover {
            color: #000;
            text-decoration: underline;
        }

        hr {
            background: #787878;
        }

        .table thead.bg-dark tr th {
            color: #fff;
        }

        .table tbody tr td {
            padding: 10px 5px;
            font-size: 14px;
        }

        .table tbody tr td h6 {
            font-size: 15px;
        }
    </style>
    <x-customer-profile>
        <div class="add_box">
            <h3 class="mb-0">My Orders</h3>
            <hr>
            <div class="table-responsive-xxl border-0">
                <!-- Table -->
                <table class="table mb-0 text-nowrap table-centered">
                    <!-- Table Head -->
                    <thead class="bg-dark text-white">
                        <tr class="bg-dark">
                            {{-- <th>&nbsp;</th> --}}
                            <th>Order ID</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Total Items</th>
                            <th>Total</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($customer->orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->first_name }}</td>
                                <td>{{ $order->last_name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->items_count }}</td>
                                <td>${{ number_format($order->grand_total ?? 0, 2) }}</td>
                                <td class="text-center">
                                    @switch($order->status)
                                        @case('pending')
                                            <span class="bg-warning py-1 px-2 rounded">{{ $order->status }}</span>
                                        @break

                                        @case('Invoice Created')
                                            <span class="bg-info py-1 px-2 rounded">{{ $order->status }}</span>
                                        @break

                                        @case('Shipped')
                                            <span class="bg-info py-1 px-2 rounded">{{ $order->status }}</span>
                                        @break

                                        @case('cancelled')
                                            <span class="bg-danger py-1 px-2 rounded">{{ $order->status }}</span>
                                        @break

                                        @default
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('customer.order.details', $order->id) }}">
                                        <i class='bx bx-receipt'></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </x-customer-profile>
</x-app-layout>
