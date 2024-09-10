<x-app-layout>
    <x-customer-profile>
        <div class="add_box">
            <h3 class="mb-0">Order Details</h3>
            <hr>
            <div class="col-md-12 order-detail">
                <div class="tab-content product-description-tab" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-Information" role="tabpanel"
                        aria-labelledby="pills-Information-tab">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="secton-title p-2 fw-semibold fs-5  bg-light">
                                                    <span>Order Information</span>
                                                </div>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td> Order Date </td>
                                                            <td>{{ $order->created_at->format('Y-m-d H:i:s A') }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Order Status</td>
                                                            <td> {{ $order->status }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Shops</td>
                                                            <td>-|-</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Update Picked up / delivered Date
                                                            </td>
                                                            <td>
                                                                <p>{{ $order->delivery_date }}</p>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="secton-title p-2 fw-semibold fs-5 bg-light">
                                                    <span>Account Information</span>
                                                </div>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td> Customer Name </td>
                                                            <td>{{ $order->first_name . ' ' . $order->last_name }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Email</td>
                                                            <td> {{ $order->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Phone No.</td>
                                                            <td>{{ $order->phone }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Customer Group</td>
                                                            <td>General</td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        Address
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse show"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="secton-title p-2 fw-semibold fs-5  bg-light">
                                                    <span>Billing Address</span>
                                                </div>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Name </td>
                                                            <td>{{ $order->address?->first_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Email</td>
                                                            <td> {{ $order->address?->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Contact</td>
                                                            <td>{{ $order->address?->phone }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> City</td>
                                                            <td>{{ $order->address?->city }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> State</td>
                                                            <td>{{ $order->address?->state }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Country</td>
                                                            <td>Canada</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pin Code</td>
                                                            <td>{{ $order->address?->pincode }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Address</td>
                                                            <td>
                                                                {{ $order->address?->address }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Comments</td>
                                                            <td>{{ $order->note }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="secton-title p-2 fw-semibold fs-5 bg-light">
                                                    <span>Shipping Address</span>
                                                </div>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Name </td>
                                                            <td>{{ $order->address?->first_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Email</td>
                                                            <td> {{ $order->address?->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Contact</td>
                                                            <td>{{ $order->address?->phone }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> City</td>
                                                            <td>{{ $order->address?->city }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> State</td>
                                                            <td>{{ $order->address?->state }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Country</td>
                                                            <td>Canada</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pin Code</td>
                                                            <td>{{ $order->address?->pincode }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Address</td>
                                                            <td>
                                                                {{ $order->address?->address }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Comments</td>
                                                            <td>{{ $order->note }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Payment and Shipping
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse show"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="secton-title p-2 fw-semibold fs-5  bg-light">
                                                    <span>Payment Information</span>
                                                </div>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Payment Method </td>
                                                            <td>{{ $order->shipping_method }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Currency</td>
                                                            <td> USD</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Payment Order Id</td>
                                                            <td> #{{$order->id}}</td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="secton-title p-2 fw-semibold fs-5 bg-light">
                                                    <span>Shipping Information</span>
                                                </div>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td> Shipping Method </td>
                                                            <td>delivery</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Shipping Price</td>
                                                            <td> $0.00</td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour" aria-expanded="false"
                                        aria-controls="collapseFour">
                                        Products Ordered
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse show"
                                    aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Sl</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">SKU</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Price</th>
                                                    {{-- <th scope="col">Tax Percent</th>
                                                    <th scope="col">Tax Amount</th> --}}
                                                    <th scope="col">Grand Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->items as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->sku }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>${{ $item->price }}</td>
                                                        <td>${{ $item->total_amount }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="sale-summary">
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <td>Subtotal</td>
                                                        <td>-</td>
                                                        <td class="width150">${{ number_format($order->total_amount?? 0, 2) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tax </td>
                                                        <td>-</td>
                                                        <td> ${{ number_format($order->tax_total?? 0, 2) }} </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Discount </td>
                                                        <td>-</td>
                                                        <td> ${{ number_format($order->discount_amount?? 0, 2) }} </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Delivery Charge </td>
                                                        <td>-</td>
                                                        <td> ${{ number_format($order->delivery_charge?? 0, 2) }} </td>
                                                    </tr>
                                                    <tr class="fw-bold pt-2">
                                                        <td>Grand Total</td>
                                                        <td>-</td>
                                                        <td>${{ number_format($order->grand_total?? 0, 2) }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-customer-profile>
    <style>
        td {
            padding: 7px 10px !important;
            font-size: 14px !important;
        }
        .sale-summary .table-striped{
            width: 40%;
            margin-left: auto;
        }
    </style>
</x-app-layout>
