<x-admin-layout>
    <div class="main shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header px-0">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <h3>Coupon Codes</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="form-card">
                        <div class="row mb-2">
                            <div class="col-lg-2 my-auto text-end ms-auto">
                                <a href="{{ route('coupon.create') }}" class="add-btn bg-success text-white">Add
                                    Coupon</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @php
                        $columns = [['label' => 'Id', 'column' => 'id', 'sort' => true], ['label' => 'Name', 'column' => 'name', 'sort' => true], ['label' => 'From', 'column' => 'from', 'sort' => true], ['label' => 'To', 'column' => 'to', 'sort' => true], ['label' => 'Actions', 'column' => 'action', 'sort' => false]];
                    @endphp
                    <x-utility.table :columns="$columns" :data="$coupons" :route="route('coupons')">
                        @foreach ($coupons as $key => $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ (new DateTime($item->from))->format('d-m-Y') }}</td>
                                <td>{{ (new DateTime($item->to))->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('coupon.edit', $item->id) }}">
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <a onclick="return confirm('Are you sure you want to delete this?')"
                                        href="{{ route('coupon.delete', $item->id) }}">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </x-utility.table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
