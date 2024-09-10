<x-admin-layout>
    <div class="main shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <a onclick="history.length > 1 ? history.go(-1) : window.location = window.location.origin;">
                                <i class="fas fa-chevron-left fs-5"></i>
                            </a>
                            <x-utility.additional.title title="Refund Create" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="accordion-item mt-3">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Products Ordered
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse show" aria-labelledby="headingFour"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Sl</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">SKU</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Grand Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->items as $key => $item)
                                            <tr>
                                                <td>
                                                    <input onchange="calculate()" type="checkbox" class="item"
                                                        name="refund_items[]" value="{{ $item->id }}"
                                                        data-amount="{{ $item->total_amount }}">
                                                </td>
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
                                <form action="{{ route('refund.create',$order->id) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="items" id="items">
                                    <div class="row my-2 g-2">
                                        <x-utility.forms.input label="Total Amount" type="number" name="total_amt"
                                            id="total_amt" :required="true" size="col-lg-6" :value="$order->grand_total"
                                            class="" :readonly="true" />
                                        <x-utility.forms.input label="Refund Amount" type="number" name="refund_amt"
                                            id="refund_amt" :required="true" size="col-lg-6" class="" />
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <x-utility.forms.button type="submit" label="Submit" class="submit-btn" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function calculate() {
                var items = [];
                var refund = 0;
                $(".item:checked").each(function() {
                    var id = $(this).val();
                    var amount = $(this).data("amount");
                    console.log(amount, 'amount');
                    refund += amount;
                    items.push(id)
                });
                $('#refund_amt').val(refund);
                $('#items').val(items);
            }
        </script>
    @endpush
</x-admin-layout>
