<x-admin-layout>
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header px-0">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <h3>Shipments</h3>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @php
                        $columns = [
                            ['label' => '#', 'column' => 'id', 'sort' => true],
                            ['label' => 'Order Id', 'column' => 'id', 'sort' => true],
                            ['label' => 'Customer name', 'column' => 'first_name', 'sort' => true],
                            ['label' => 'Total Qty', 'column' => 'items_qty', 'sort' => true],
                            ['label' => 'Shipping method', 'column' => 'shipping_method', 'sort' => true],
                            ['label' => 'Order Date', 'column' => 'created_at', 'sort' => true],
                            ['label' => 'Shipment Date', 'column' => 'shipped_date', 'sort' => true],
                            ['label' => 'Actions', 'column' => 'action', 'sort' => false],
                        ];
                    @endphp
                    <x-utility.table :columns="$columns" :data="$orders" :route="route('order.shipments')">
                        @foreach ($orders as $key => $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->first_name . ' ' . $item->last_name }}</td>
                                <td>{{ $item->items_qty }}</td>
                                <td>{{ $item->shipping_method }}</td>
                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->shipped_date)->format('d-m-Y') }}</td>
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
                table.to_date = to_date ? to_date : '';
                $('#to_date').val(to_date ? to_date : '');

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
