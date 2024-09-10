<x-admin-layout>
    <div class="main shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header px-0">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <h3>Product List</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="form-card">
                        <div class="row mb-2">
                            <div class="col-lg-2">
                                <select name="categories" id="category">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
                            <div class="col-lg-5 my-auto text-end ms-auto">
                                <a href="{{ route('product.export') }}"
                                    class="add-btn border-0 bg-info text-white me-2">
                                    Export
                                </a>
                                <a href="{{ route('product.create') }}" class="add-btn bg-success text-white">
                                    Add Product
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (session()->has('error_msg'))
                <div style="color:red;font-size:13px;">
                    {!! session('error_msg') !!}
                </div>
            @endif
            <div class="row">
                @php
                    $columns = [
                        ['label' => 'Id', 'column' => 'id', 'sort' => true],
                        ['label' => 'SKU', 'column' => 'sku ', 'sort' => true],
                        ['label' => 'Name', 'column' => 'name', 'sort' => true],
                        ['label' => 'New Name', 'column' => 'name', 'sort' => false],
                        ['label' => 'New', 'column' => 'is_new', 'sort' => false],
                        ['label' => 'Featured', 'column' => 'is_featured', 'sort' => false],
                        ['label' => 'Status', 'column' => 'status', 'sort' => true],
                        ['label' => 'Price', 'column' => 'price', 'sort' => true],
                        ['label' => 'New Price', 'column' => 'price', 'sort' => false],
                        ['label' => 'Actions', 'column' => 'action', 'sort' => false],
                    ];
                    $type = 'product';
                @endphp
                <x-utility.table :columns="$columns" :data="$products" :checkAll=true :route="route('products')" :type="$type">
                    @foreach ($products as $key => $item)
                        <tr>
                            <td>
                                <input type="checkbox" name="" class="checkinput" value="{{ $item->id }}">
                            </td>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->sku }}</td>
                            <td>{{ $item->name }}</td>
                            <td style="width: 20%;">
                                <input type="text" class="new-name-input" data-item-id="{{ $item->id }}">
                            </td>
                            <td>{{ $item->is_new ? 'Yes' : 'No' }}</td>
                            <td>{{ $item->is_featured ? 'Yes' : 'No' }}</td>
                            <td>
                                @if ($item->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">In-Active</span>
                                @endif
                            </td>
                            <td style="white-space: nowrap;">$ {{ $item->price }}</td>
                            <td>
                                <input type="number" style="width: 80px;" class="new-price-input"
                                    data-item-id="{{ $item->id }}">
                            </td>
                            <td>
                                <a href="{{ route('product.edit', $item->id) }}">
                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                </a>
                                <a onclick="return confirm('Are you sure you want to delete this?')"
                                    href="{{ route('product.delete', $item->id) }}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </x-utility.table>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/js/product.js') }}"></script>
        <script>
            $('.deleteRecord').on('click', function() {
                var id = $(this).data('id');
                if (confirm('Are you sure you want to delete this?')) {
                    $(`#${id}`).submit();
                }
            });
            $('.new-name-input').on('change', function() {
                console.log("working");
                let itemId = $(this).data('item-id');
                let route_name = "{{ route('products') }}";
                let new_name = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    type: "POST",
                    url: route_name + "/update_name",
                    datatype: "text",
                    data: {
                        id: itemId,
                        new_name: new_name
                    },
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {}
                });
            });
            $('.new-price-input').on('change', function() {
                let itemId = $(this).data('item-id');
                let route_name = "{{ route('products') }}";
                let new_price = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    type: "POST",
                    url: route_name + "/update_price",
                    datatype: "text",
                    data: {
                        id: itemId,
                        new_price: new_price
                    },
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {}
                });
            });
            var table = {
                category: '',
                from_date: '',
                to_date: '',
            }
            $(document).ready(function() {
                let category = new URLSearchParams(window.location.search).get("category");
                let from_date = new URLSearchParams(window.location.search).get("from_date");
                let to_date = new URLSearchParams(window.location.search).get("to_date");
                table.category = category ? category : '';
                $('#category').val(category ? category : '');
                table.from_date = from_date ? from_date : '';
                $('#from_date').val(from_date ? from_date : '');
                table.to_date = to_date ? to_date : '';
                $('#to_date').val(to_date ? to_date : '');

            });
            $('#category').on('change', function(e) {
                e.preventDefault();
                table.category = $(this).val();
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
