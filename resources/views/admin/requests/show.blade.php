<x-admin-layout>
    <div class="main shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <x-utility.additional.title title="Product request" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 mx-auto">
                    <div class="form-section mt-3 show-details">
                        <table>
                            <tr>
                                <th class="p-2">First Name</th>
                                <td>{{ $prequest->first_name }}</td>
                            </tr>
                            <tr>
                                <th class="p-2">Last Name</th>
                                <td>{{ $prequest->last_name }}</td>
                            </tr>
                            <tr>
                                <th class="p-2">Email</th>
                                <td>{{ $prequest->email }}</td>
                            </tr>
                            <tr>
                                <th class="p-2">Phone</th>
                                <td>{{ $prequest->phone }}</td>
                            </tr>
                            <tr>
                                <th class="p-2">Brand</th>
                                <td>{{ $prequest->brand }}</td>
                            </tr>
                            <tr>
                                <th class="p-2">Product</th>
                                <td>{{ $prequest->product_name }}</td>
                            </tr>
                            <tr>
                                <th class="p-2">Message</th>
                                <td>{{ $prequest->message }}</td>
                            </tr>
                            <tr>
                                <th class="p-2">Product Image</th>
                                <td>
                                    <img src="{{ asset($prequest->image) }}" alt="" style="max-height: 200px;">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
