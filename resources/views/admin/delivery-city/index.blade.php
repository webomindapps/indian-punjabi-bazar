<x-admin-layout>
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header px-0">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <h3>Delivery City</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="form-card">
                        <div class="row mb-2">
                            <div class="col-lg-5 my-auto text-end ms-auto">
                                <a href="{{ route('delivery.city.create') }}" class="add-btn bg-success text-white">
                                    Add Delivery City
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mt-4">
                    <div class="form-card px-3">
                        @php
                            $columns = [
                                ['label' => 'Id', 'column' => 'id', 'sort' => true],
                                ['label' => 'City', 'column' => 'city', 'sort' => true],
                                ['label' => 'Delivery Price', 'column' => 'delivery_price', 'sort' => true],
                                [
                                    'label' => 'Minimum Delivery Price',
                                    'column' => 'min_amt_for_shipping',
                                    'sort' => true,
                                ],
                                ['label' => 'Status', 'column' => 'status', 'sort' => false],
                                ['label' => 'Actions', 'column' => 'action', 'sort' => false],
                            ];
                        @endphp

                        <x-utility.table :columns="$columns" :data="$deliveryCities" :checkAll=true :route="route('delivery.cities')">
                            @foreach ($deliveryCities as $key => $item)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="" class="checkinput"
                                            value="{{ $item->id }}">
                                    </td>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        {{ $item->city }}
                                    </td>
                                    <td>
                                        {{ $item->delivery_price }}
                                    </td>
                                    <td>
                                        {{ $item->min_amt_for_shipping }}
                                    </td>
                                    <td>
                                        @if ($item->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">In-Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('delivery.city.edit', $item->id) }}">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                        {{-- <a onclick="return confirm('Are you sure you want to delete this?')"
                                            href="{{ route('delivery.city.delete', $item->id) }}">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </x-utility.table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
