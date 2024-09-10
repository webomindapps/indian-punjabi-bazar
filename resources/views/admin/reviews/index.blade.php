<x-admin-layout>
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header px-0">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <h3>Reviews</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @php
                        $columns = [
                            ['label' => 'Id', 'column' => 'id', 'sort' => true],
                            ['label' => 'Title', 'column' => 'title', 'sort' => true],
                            ['label' => 'Comment', 'column' => 'description', 'sort' => true],
                            ['label' => 'Product', 'column' => 'product', 'sort' => false],
                            ['label' => 'Status', 'column' => 'status', 'sort' => false],
                            ['label' => 'Actions', 'column' => 'action', 'sort' => false],
                        ];
                    @endphp
                    <x-utility.table :columns="$columns" :data="$reviews" :checkAll=true :route="route('reviews')">
                        @foreach ($reviews as $key => $item)
                            <tr>
                                <td>
                                    <input type="checkbox" name="" class="checkinput" value="{{ $item->id }}">
                                </td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>
                                    @if ($item->status == 0)
                                        <span class="status_spn bg-warning">Pending</span>
                                    @else
                                        <span class="status_spn bg-success">Approved</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('review.edit', $item->id) }}">
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <a onclick="return confirm('Are you sure you want to delete this?')"
                                        href="{{ route('review.delete', $item->id) }}">
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
    <style>
        .status_spn {
            padding: 3px 10px;
            border-radius: 15px;
            color: white;
        }
    </style>
</x-admin-layout>
