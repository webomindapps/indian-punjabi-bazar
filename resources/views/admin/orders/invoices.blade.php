<x-admin-layout>
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header px-0">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <h3>Invoices</h3>
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
                            ['label' => '#', 'column' => 'id', 'sort' => false],
                            ['label' => 'Order Id', 'column' => 'id', 'sort' => true],
                            ['label' => 'Customer name', 'column' => 'first_name', 'sort' => true],
                            ['label' => 'Invoice Date', 'column' => 'invoice_date', 'sort' => true],
                            ['label' => 'Shipping method', 'column' => 'shipping_method', 'sort' => true],
                            ['label' => 'Sub total', 'column' => 'total_amount', 'sort' => true],
                            ['label' => 'Grand total', 'column' => 'grand_total', 'sort' => true],
                            ['label' => 'Actions', 'column' => 'action', 'sort' => false],
                        ];
                    @endphp
                    <x-utility.table :columns="$columns" :data="$orders" :route="route('order.invoices')">
                        @foreach ($orders as $key => $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->first_name . ' ' . $item->last_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->invoice_date)->format('d-m-Y') }}</td>
                                <td>{{ $item->shipping_method }}</td>
                                <td>$ {{ number_format($item->total_amount ?? 0, 2) }}</td>
                                <td>$ {{ number_format($item->grand_total ?? 0, 2) }}</td>
                                <td>
                                    <a href="{{ route('invoice.details', $item->id) }}">
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
