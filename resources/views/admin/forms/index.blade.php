<x-admin-layout>
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header px-0">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <h3>Forms</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="form-card">
                        <div class="row mb-2">
                            <div class="col-lg-2 my-auto text-end ms-auto">
                                <a href="{{ route('productform.create') }}" class="add-btn bg-success text-white">Add
                                    Form</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mt-4">
                    <div class="form-card px-3">
                        @php
                            $columns = [
                                ['label' => 'Id', 'column' => 'id', 'sort' => true],
                                ['label' => 'Name', 'column' => 'form', 'sort' => true],
                                ['label' => 'Actions', 'column' => 'action', 'sort' => false],
                            ];
                        @endphp

                        <x-utility.table :columns="$columns" :data="$forms" :checkAll=false :route="route('productforms')">
                            @foreach ($forms as $key => $item)
                                <tr>
                                    {{-- <td>
                                    <input type="checkbox" name="" class="checkinput" value="{{ $item->id }}">
                                </td> --}}
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->form }}</td>
                                    <td>
                                        <a href="{{ route('productform.edit', $item->id) }}">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <a onclick="return confirm('Are you sure you want to delete this?')"
                                            href="{{ route('productform.delete', $item->id) }}">
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
    </div>
</x-admin-layout>