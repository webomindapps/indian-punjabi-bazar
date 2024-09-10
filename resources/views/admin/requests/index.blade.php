<x-admin-layout>
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header px-0">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <h3>Product Requests</h3>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-12 mt-4">
                    <div class="form-card px-3">
                        <div class="row mb-2">
                            <div class="col-md-5">
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
                                <a href="{{ route('subscriber.export') }}" class="add-btn border-0 bg-info text-white">
                                    Export
                                </a>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="col-lg-12 mt-4">
                    <div class="form-card px-3">
                        @php
                            $columns = [
                                ['label' => 'Id', 'column' => 'id', 'sort' => true],
                                ['label' => 'Name', 'column' => 'first_name', 'sort' => true],
                                ['label' => 'Email', 'column' => 'email', 'sort' => true],
                                ['label' => 'Telephone', 'column' => 'phone', 'sort' => true],
                                ['label' => 'Brand', 'column' => 'brand', 'sort' => true],
                                ['label' => 'Product', 'column' => 'product', 'sort' => true],
                                ['label' => 'Actions', 'column' => 'action', 'sort' => false],
                            ];
                        @endphp

                        <x-utility.table :columns="$columns" :data="$requests" :checkAll=false :route="route('product.requests')">
                            @foreach ($requests as $key => $item)
                                <tr>
                                    {{-- <td>
                                    <input type="checkbox" name="" class="checkinput" value="{{ $item->id }}">
                                </td> --}}
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->first_name.' '.$item->last_name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->brand }}</td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>
                                        <a href="{{route('product.request.show',$item->id)}}">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <a onclick="return confirm('Are you sure you want to delete this?')"
                                            href="{{ route('product.request.delete', $item->id) }}">
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