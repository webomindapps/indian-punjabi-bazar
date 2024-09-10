<x-admin-layout>
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header px-0">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <h3>Order List</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="form-card">
                        <div class="row mb-2">
                            <div class="col-lg-5">
                                <div class="row justify-content-start">
                                    <div class="col-lg-5">
                                        <div class="cdate">
                                            <input type="date" class="form-control" name="from_date" id="from_date">
                                        </div>
                                    </div>
                                    <div class="col-lg-1 text-center my-auto">
                                        <span class="fw-semibold fs-6">To</span>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="cdate">
                                            <input type="date" class="form-control" name="to_date" id="to_date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <select name="delivery_type" id="delivery_type">
                                    <option value="">All</option>
                                    <option value="delivery">Delivery</option>
                                    <option value="pickup">Pickup</option>
                                </select>
                            </div>
                            <div class="col-lg-3 ms-auto">
                                <form action="{{ route('order.export') }}" class="text-end" method="POST">
                                    @csrf
                                    <input type="hidden" name="fromDt" id="fromDt">
                                    <input type="hidden" name="toDt" id="toDt">
                                    <button type="submit" class="add-btn border-0 bg-info text-white">Export</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @php
                        $columns = [
                            ['label' => 'Id', 'column' => 'id', 'sort' => true],
                            ['label' => 'Customer name', 'column' => 'first_name', 'sort' => true],
                            ['label' => 'Delivery type', 'column' => 'delivery_type', 'sort' => true],
                            ['label' => 'Pickup/Delivery Date', 'column' => 'date', 'sort' => true],
                            ['label' => 'Order Date', 'column' => 'created_at', 'sort' => true],
                            ['label' => 'Order Type', 'column' => 'shipping_method', 'sort' => true],
                            ['label' => 'Sub total', 'column' => 'total_amount', 'sort' => true],
                            ['label' => 'Grand total', 'column' => 'grand_total', 'sort' => true],
                            ['label' => 'Order status', 'column' => 'status', 'sort' => false],
                            ['label' => 'Picked Up/Delivered Date', 'column' => 'date', 'sort' => true],
                            ['label' => 'Actions', 'column' => 'action', 'sort' => false],
                        ];
                    @endphp
                    <x-utility.table :columns="$columns" :data="$orders" :route="route('orders')">
                        @foreach ($orders as $key => $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->first_name . ' ' . $item->last_name }}</td>
                                <td>{{ $item->delivery_type }}</td>
                                <td>
                                    @if ($item->date)
                                        {{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}
                                    @endif
                                    <span style="white-space: nowrap;">{{ $item->time }}</span>
                                </td>
                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                <td>{{ $item->shipping_method }}</td>
                                <td>$ {{ number_format($item->total_amount + $item->tax_total ?? 0, 2) }}</td>
                                <td>$ {{ number_format($item->grand_total ?? 0, 2) }}</td>
                                <td>
                                    {{ $item->status }}
                                    {{-- @switch($item->status)
                                        @case('pending')
                                            <span class="status_spn bg-warning">Pending</span>
                                        @break

                                        @case('cancel')
                                            <span class="status_spn bg-danger">Cancelled</span>
                                        @break

                                        @case('complete')
                                            <span class="status_spn bg-success">Complete</span>
                                        @break

                                        @default
                                    @endswitch --}}
                                </td>
                                <td>
                                    @if ($item->delivery_date)
                                        {{ \Carbon\Carbon::parse($item->delivery_date)->format('d-m-Y') }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('order.details', $item->id) }}">
                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </x-utility.table>
                </div>
            </div>
        </div>
    </div>
    <style>
        .status_spn {
            padding: 3px 10px;
            border-radius: 15px;
            color: white;
        }
    </style>
    @push('scripts')
        <script>
            var table = {
                delivery_type: '',
                from_date: '',
                to_date: '',
            }
            $(document).ready(function() {
                let delivery_type = new URLSearchParams(window.location.search).get("delivery_type");
                let from_date = new URLSearchParams(window.location.search).get("from_date");
                let to_date = new URLSearchParams(window.location.search).get("to_date");
                table.delivery_type = delivery_type ? delivery_type : '';
                $('#delivery_type').val(delivery_type ? delivery_type : '');
                table.from_date = from_date ? from_date : '';
                $('#from_date').val(from_date ? from_date : '');
                $('#fromDt').val(from_date ? from_date : '');
                table.to_date = to_date ? to_date : '';
                $('#to_date').val(to_date ? to_date : '');
                $('#toDt').val(to_date ? to_date : '');

            });
            $('#delivery_type').on('change', function(e) {
                e.preventDefault();
                table.delivery_type = $(this).val();
                getRecords();
            });
            $('#from_date').on('change', function(e) {
                e.preventDefault();
                table.from_date = $(this).val();
                getRecords();
            });
            $('#to_date').on('change', function(e) {
                e.preventDefault();
                table.to_date = $(this).val();
                getRecords();
            });
        </script>
    @endpush
</x-admin-layout>
