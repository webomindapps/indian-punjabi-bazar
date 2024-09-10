<x-admin-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <a onclick="history.length > 1 ? history.go(-1) : window.location = window.location.origin;">
                                <i class="fas fa-chevron-left fs-5"></i>
                            </a>
                            <h3>Order #{{ $order->id }}</h3>
                        </div>
                        <div class="col-lg-8 text-end">
                            @if (!$order->is_invoice_created)
                                <a onclick="return confirm('are you sure?')"
                                    href="{{ route('order.cancel', $order->id) }}"
                                    class="submit-btn bg-danger mt-0 text-white d-inline-block">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                                <a onclick="return confirm('are you sure?')"
                                    href="{{ route('invoice.generate', $order->id) }}"
                                    class="submit-btn bg-success mt-0 text-white d-inline-block">
                                    <i class="fas fa-file-invoice me-2"></i>Invoice
                                </a>
                            @endif
                            @if (!$order->is_shipped)
                                <a onclick="return confirm('are you sure?')"
                                    href="{{ route('shipment.create', $order->id) }}"
                                    class="submit-btn bg-warning mt-0 text-white d-inline-block">
                                    <i class="fas fa-shipping-timed me-2"></i>Shipment
                                </a>
                            @else
                                {{-- {{ route('refund.create', $order->id) }} --}}
                                @if (!$order->is_refunded)
                                    <a href="{{ route('refund.create', $order->id) }}"
                                        class="submit-btn bg-warning mt-0 text-white d-inline-block">
                                        <i class="fas fa-shipping-timed me-2"></i>Refund
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <div class="col-md-12">
                        <div class="col-md-12 order-detail">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-Information-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-Information" type="button" role="tab"
                                        aria-controls="pills-Information" aria-selected="true">Information
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-Invoices-tab" data-bs-toggle="tab"
                                        data-bs-target="#pills-Invoices" type="button" role="tab"
                                        aria-controls="pills-Invoices" aria-selected="false">
                                        Invoices
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-Shipments-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-Shipments" type="button" role="tab"
                                        aria-controls="pills-Shipments" aria-selected="false">Shipments
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-page="fds" id="pills-Refunds-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-Refunds" type="button"
                                        role="tab" aria-controls="pills-Refunds" aria-selected="false">Refunds
                                    </button>
                                </li>
                            </ul>


                            <div class="tab-content product-description-tab" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-Information" role="tabpanel"
                                    aria-labelledby="pills-Information-tab">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                    aria-expanded="false" aria-controls="collapseOne">
                                                    Order and Account
                                                </button>
                                            </h2>
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
                                                                            <form class="d-flex align-items-center"
                                                                                action="{{ route('orders.updatedelivery', $order->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                <input type="date"
                                                                                    name="delivery_date"
                                                                                    min="{{ date('Y-m-d') }}"
                                                                                    value="{{ $order->delivery_date }}"
                                                                                    class="form-control">
                                                                                <button class="btn btn-sm btn-success"
                                                                                    type="submit">Update</button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> Delivery Details
                                                                        </td>
                                                                        <td>
                                                                            {{ $order->city }} ,{{ $order->time }}
                                                                            ,{{ date('d-m-Y', strtotime($order->date)) }}
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
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="true" aria-controls="collapseTwo">
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
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
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
                                                                        <td>{{$order->payment_id}}</td>
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
                                                                        <td>{{$order->delivery_type}}</td>
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
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                    aria-expanded="false" aria-controls="collapseFour">
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
                                                                    <td>${{ number_format($item->price ?? 0, 2) }}</td>
                                                                    <td>${{ number_format($item->total_amount ?? 0, 2) }}
                                                                    </td>
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
                                                                    <td class="width150">
                                                                        ${{ number_format($order->total_amount ?? 0, 2) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Tax </td>
                                                                    <td>-</td>
                                                                    <td> ${{ number_format($order->tax_total ?? 0, 2) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Discount </td>
                                                                    <td>-</td>
                                                                    <td> ${{ number_format($order->discount_amount ?? 0, 2) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Delivery Charge </td>
                                                                    <td>-</td>
                                                                    <td> ${{ number_format($order->delivery_charge ?? 0, 2) }}
                                                                    </td>
                                                                </tr>
                                                                <tr class="fw-bold pt-2">
                                                                    <td>Grand Total</td>
                                                                    <td>-</td>
                                                                    <td>${{ number_format($order->grand_total ?? 0, 2) }}
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-Invoices" role="tabpanel"
                                    aria-labelledby="pills-Invoices-tab">
                                    @if ($order->is_invoice_created)
                                        <div class="accordion" id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                        aria-expanded="false" aria-controls="collapseOne">
                                                        Order and Account
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show"
                                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div
                                                                    class="secton-title p-2 fw-semibold fs-5  bg-light">
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
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div
                                                                    class="secton-title p-2 fw-semibold fs-5 bg-light">
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
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                        aria-expanded="true" aria-controls="collapseTwo">
                                                        Address
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse show"
                                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div
                                                                    class="secton-title p-2 fw-semibold fs-5  bg-light">
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
                                                                <div
                                                                    class="secton-title p-2 fw-semibold fs-5 bg-light">
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
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                        aria-expanded="false" aria-controls="collapseThree">
                                                        Payment and Shipping
                                                    </button>
                                                </h2>
                                                <div id="collapseThree" class="accordion-collapse collapse show"
                                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div
                                                                    class="secton-title p-2 fw-semibold fs-5  bg-light">
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
                                                                            <td>{{$order->payment_id}}</td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div
                                                                    class="secton-title p-2 fw-semibold fs-5 bg-light">
                                                                    <span>Shipping Information</span>
                                                                </div>
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td> Shipping Method </td>
                                                                            <td>{{$order->delivery_type}}</td>
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
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                        aria-expanded="false" aria-controls="collapseFour">
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
                                                                        <td>${{ number_format($item->price ?? 0, 2) }}
                                                                        </td>
                                                                        <td>${{ number_format($item->total_amount ?? 0, 2) }}
                                                                        </td>
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
                                                                        <td class="width150">
                                                                            ${{ number_format($order->total_amount ?? 0, 2) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tax </td>
                                                                        <td>-</td>
                                                                        <td> ${{ number_format($order->tax_total ?? 0, 2) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Discount </td>
                                                                        <td>-</td>
                                                                        <td> ${{ number_format($order->discount_amount ?? 0, 2) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Delivery Charge </td>
                                                                        <td>-</td>
                                                                        <td> ${{ number_format($order->delivery_charge ?? 0, 2) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="fw-bold pt-2">
                                                                        <td>Grand Total</td>
                                                                        <td>-</td>
                                                                        <td>${{ number_format($order->grand_total ?? 0, 2) }}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <label for="">No Invoice Found</label>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="pills-Shipments" role="tabpanel"
                                    aria-labelledby="pills-Shipments-tab">
                                    @if ($order->is_shipped)
                                        <div class="accordion" id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                        aria-expanded="false" aria-controls="collapseOne">
                                                        Order and Account
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show"
                                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div
                                                                    class="secton-title p-2 fw-semibold fs-5  bg-light">
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
                                                                            <td> Shipment Date</td>
                                                                            <td>
                                                                                {{ date('d-m-Y', strtotime($order->shipped_date)) }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> Shipment Name</td>
                                                                            <td> {{ $order->shipment_name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> Shipment ID</td>
                                                                            <td> {{ $order->shipment_id }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> Tracking ID</td>
                                                                            <td> {{ $order->tracking_id }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div
                                                                    class="secton-title p-2 fw-semibold fs-5 bg-light">
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
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                        aria-expanded="true" aria-controls="collapseTwo">
                                                        Address
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse show"
                                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div
                                                                    class="secton-title p-2 fw-semibold fs-5  bg-light">
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
                                                                <div
                                                                    class="secton-title p-2 fw-semibold fs-5 bg-light">
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
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                        aria-expanded="false" aria-controls="collapseThree">
                                                        Payment and Shipping
                                                    </button>
                                                </h2>
                                                <div id="collapseThree" class="accordion-collapse collapse show"
                                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div
                                                                    class="secton-title p-2 fw-semibold fs-5  bg-light">
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
                                                                            <td>{{$order->payment_id}}</td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div
                                                                    class="secton-title p-2 fw-semibold fs-5 bg-light">
                                                                    <span>Shipping Information</span>
                                                                </div>
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td> Shipping Method </td>
                                                                            <td>{{$order->delivery_type}}</td>
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
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                        aria-expanded="false" aria-controls="collapseFour">
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
                                                                        <td>${{ number_format($item->price ?? 0, 2) }}
                                                                        </td>
                                                                        <td>${{ number_format($item->total_amount ?? 0, 2) }}
                                                                        </td>
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
                                                                        <td class="width150">$
                                                                            {{ number_format($order->total_amount ?? 0, 2) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tax </td>
                                                                        <td>-</td>
                                                                        <td> ${{ number_format($order->tax_total ?? 0, 2) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Discount </td>
                                                                        <td>-</td>
                                                                        <td> ${{ number_format($order->discount_amount ?? 0, 2) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Delivery Charge </td>
                                                                        <td>-</td>
                                                                        <td> ${{ number_format($order->delivery_charge ?? 0, 2) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="fw-bold pt-2">
                                                                        <td>Grand Total</td>
                                                                        <td>-</td>
                                                                        <td>${{ number_format($order->grand_total ?? 0, 2) }}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <label for="">No Shipment Found</label>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="pills-Refunds" role="tabpanel"
                                    aria-labelledby="pills-Refunds-tab">
                                    @if ($order->is_refunded)
                                        <div class="accordion" id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                        aria-expanded="false" aria-controls="collapseOne">
                                                        Order and Account
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show"
                                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div
                                                                    class="secton-title p-2 fw-semibold fs-5  bg-light">
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
                                                                            <td> Refunded Amount</td>
                                                                            <td> ${{ $order?->refund?->refund_amount }}
                                                                            </td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div
                                                                    class="secton-title p-2 fw-semibold fs-5 bg-light">
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
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                        aria-expanded="true" aria-controls="collapseTwo">
                                                        Address
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse show"
                                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div
                                                                    class="secton-title p-2 fw-semibold fs-5  bg-light">
                                                                    <span>Billing Address</span>
                                                                </div>
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Name </td>
                                                                            <td>{{ $order->address?->first_name }}
                                                                            </td>
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
                                                                <div
                                                                    class="secton-title p-2 fw-semibold fs-5 bg-light">
                                                                    <span>Shipping Address</span>
                                                                </div>
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Name </td>
                                                                            <td>{{ $order->address?->first_name }}
                                                                            </td>
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
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                        aria-expanded="false" aria-controls="collapseThree">
                                                        Payment and Shipping
                                                    </button>
                                                </h2>
                                                <div id="collapseThree" class="accordion-collapse collapse show"
                                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div
                                                                    class="secton-title p-2 fw-semibold fs-5  bg-light">
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
                                                                            <td>{{$order->payment_id}}</td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div
                                                                    class="secton-title p-2 fw-semibold fs-5 bg-light">
                                                                    <span>Shipping Information</span>
                                                                </div>
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td> Shipping Method </td>
                                                                            <td>{{$order->delivery_type}}</td>
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
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                        aria-expanded="false" aria-controls="collapseFour">
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
                                                                        <td>${{ number_format($item->price ?? 0, 2) }}
                                                                        </td>
                                                                        <td>${{ number_format($item->total_amount ?? 0, 2) }}
                                                                        </td>
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
                                                                        <td class="width150">$
                                                                            {{ number_format($order->total_amount ?? 0, 2) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tax </td>
                                                                        <td>-</td>
                                                                        <td> ${{ number_format($order->tax_total ?? 0, 2) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Discount </td>
                                                                        <td>-</td>
                                                                        <td> ${{ number_format($order->discount_amount ?? 0, 2) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Delivery Charge </td>
                                                                        <td>-</td>
                                                                        <td> ${{ number_format($order->delivery_charge ?? 0, 2) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="fw-bold pt-2">
                                                                        <td>Grand Total</td>
                                                                        <td>-</td>
                                                                        <td>${{ number_format($order->grand_total ?? 0, 2) }}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <label for="">No Refund found</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
