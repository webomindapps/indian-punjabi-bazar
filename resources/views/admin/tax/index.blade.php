<x-admin-layout>
    <div class="main shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header px-0">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <h3>Taxes</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="form-card">
                        <div class="row mb-2">
                            <div class="col-lg-2 my-auto text-end ms-auto">
                                <a href="{{ route('tax.create') }}" class="add-btn bg-success text-white">
                                    Add Tax
                                </a>
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
                        $columns = [
                            ['label' => 'Id', 'column' => 'id', 'sort' => true],
                            ['label' => 'Title', 'column' => 'title', 'sort' => true],
                            ['label' => 'Tax', 'column' => 'percent', 'sort' => true],
                            ['label' => 'Status', 'column' => 'status', 'sort' => false],
                            ['label' => 'Actions', 'column' => 'action', 'sort' => false],
                        ];
                    @endphp
                    <x-utility.table :columns="$columns" :data="$taxes" :checkAll=true :route="route('taxes')">
                        @foreach ($taxes as $key => $item)
                            <tr>
                                <td>
                                    <input type="checkbox" name="" class="checkinput"
                                        value="{{ $item->id }}">
                                </td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->percent }} %</td>
                                <td>
                                    @if ($item->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">In-Active</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('tax.edit', $item->id) }}">
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <a onclick="return confirm('Are you sure you want to delete this?')"
                                        href="{{ route('tax.delete', $item->id) }}">
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
