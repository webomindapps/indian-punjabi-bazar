<x-admin-layout>
    <div class="main shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header px-0">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <h3>Customer List</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content Row -->
            <div class="row">
                <div class="col-lg-12">
                    @php
                        $columns = [
                            ['label' => 'Id', 'column' => 'id', 'sort' => true],
                            ['label' => 'First Name', 'column' => 'name', 'sort' => true],
                            ['label' => 'Last Name', 'column' => 'name', 'sort' => true],
                            ['label' => 'Email', 'column' => 'email ', 'sort' => true],
                            ['label' => 'Phone', 'column' => 'phone', 'sort' => true],
                            ['label' => 'Actions', 'column' => 'action', 'sort' => false],
                        ];
                    @endphp
                    <x-utility.table :columns="$columns" :data="$customers" :route="route('customers')">
                        @foreach ($customers as $key => $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->first_name }}</td>
                                <td>{{ $item->last_name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>
                                    <a href="{{ route('customer.edit', $item->id) }}">
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                    </a>
                                    {{-- <a href="{{ route('customer.show', $item->id) }}">
                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                    </a> --}}
                                    {{-- <a href="{{ route('customer.addresses', $item->id) }}">
                                        <i class="fas fa-list" aria-hidden="true"></i>
                                    </a> --}}
                                    <a href="{{ route('customer.delete', $item->id) }}">
                                        <i class="fas fa-trash" aria-hidden="true"></i>
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
