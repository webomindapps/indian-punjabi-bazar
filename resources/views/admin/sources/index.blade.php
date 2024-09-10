<x-admin-layout>
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header px-0">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <h3>Source</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="form-card">
                        <div class="row mb-2">
                            <div class="col-lg-2 my-auto text-end ms-auto">
                                <a href="{{ route('productsource.create') }}" class="add-btn bg-success text-white">Add
                                    Source</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mt-4">
                    <div class="form-card px-3">
                        @php
                            $columns = [
                                ['label' => 'Id', 'column' => 'id', 'sort' => true],
                                ['label' => 'Name', 'column' => 'source', 'sort' => true],
                                ['label' => 'Actions', 'column' => 'action', 'sort' => false],
                            ];
                        @endphp

                        <x-utility.table :columns="$columns" :data="$sources" :checkAll=false :route="route('productsources')">
                            @foreach ($sources as $key => $item)
                                <tr>
                                    {{-- <td>
                                    <input type="checkbox" name="" class="checkinput" value="{{ $item->id }}">
                                </td> --}}
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->source }}</td>
                                    <td>
                                        <a href="{{ route('productsource.edit', $item->id) }}">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <a onclick="return confirm('Are you sure you want to delete this?')"
                                            href="{{ route('productsource.delete', $item->id) }}">
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
