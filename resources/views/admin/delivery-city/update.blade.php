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
                            <x-utility.additional.title title="Update Delivery City" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 mx-auto">
                    <div class="form-section">
                        <form action="{{ route('delivery.city.edit', $deliveryCity->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-contents">
                                <div class="row mb-2">
                                    <x-utility.additional.form-title title="General info" size="col-lg-12" />
                                    <x-utility.forms.input label="City" type="text" name="city" id="city"
                                        :required="true" size="col-lg-8" :value="$deliveryCity->city" />
                                    <x-utility.forms.input label="Delivery Price" type="number" name="delivery_price"
                                        id="delivery_price" :required="true" size="col-lg-8" :value="$deliveryCity->delivery_price" />
                                    <x-utility.forms.input label="Minimum Amount For Shipping Charges" type="number"
                                        name="min_amt_for_shipping" id="min_amt_for_shipping" :required="true"
                                        size="col-lg-8" :value="$deliveryCity->min_amt_for_shipping" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <x-utility.forms.button type="submit" label="Update" class="submit-btn" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
