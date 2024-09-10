<x-admin-layout>
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header px-0">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <h3>Category List</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="form-card">
                        <div class="row mb-2">
                            <div class="col-lg-5 my-auto text-end ms-auto">
                                <a href="{{ route('category.export') }}" class="add-btn border-0 bg-info text-white">
                                    Export</a>
                                <a href="{{ route('category.create') }}" class="add-btn bg-success text-white">Add
                                    Category</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @php
                        $columns = [['label' => 'Id', 'column' => 'id', 'sort' => true], ['label' => 'Name', 'column' => 'name', 'sort' => true], ['label' => 'Position', 'column' => 'position', 'sort' => true], ['label' => 'Slug', 'column' => 'slug', 'sort' => true], ['label' => 'Status', 'column' => 'status', 'sort' => true],['label' => 'Number Of Products', 'column' => 'status', 'sort' => false], ['label' => 'Actions', 'column' => 'action', 'sort' => false]];
                    @endphp

                    <x-utility.table :columns="$columns" :data="$categories" :checkAll=true :route="route('categories')">
                        @foreach ($categories as $key => $item)
                            <tr>
                                <td>
                                    <input type="checkbox" name="" class="checkinput"
                                        value="{{ $item->id }}">
                                </td>
                                <td>{{ $item->id }}</td>
                                {{-- <td>
                                    <img src="{{ asset($item->icon) }}" alt="" style="height:60px;">
                                </td> --}}
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->position }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>
                                    @if ($item->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">In-Active</span>
                                    @endif
                                </td>
                                <td>{{$item->products->count()}}</td>
                                <td>
                                    <a href="{{ route('category.edit', $item->id) }}"><i class="fas fa-edit"
                                            aria-hidden="true"></i></a>
                                    <a onclick="return confirm('Are you sure you want to delete this?')"
                                        href="{{ route('category.delete', $item->id) }}"><i class="fa fa-trash"
                                            aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </x-utility.table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
@push('scripts')
    <script>
        $('.deleteRecord').on('click', function() {
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this?')) {
                $(`#${id}`).submit();
            }
        });
    </script>
@endpush
