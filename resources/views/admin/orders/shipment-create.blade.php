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
                            <x-utility.additional.title title="Shipment Create" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="form-section">
                        <form action="{{ route('shipment.create', $order->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-contents">
                                <div class="row my-2 g-2">
                                    <x-utility.forms.input label="Shipment date" type="date" name="shipped_date"
                                        id="shipped_date" :required="true" size="col-lg-6" :value="old('shipped_date')"
                                        class="" />
                                    <x-utility.forms.input label="Shipment Name" type="text" name="shipment_name"
                                        id="shipment_name" :required="true" size="col-lg-6" :value="old('shipment_name')"
                                        class="" />
                                    <x-utility.forms.input label="Shipment Id" type="text" name="shipment_id"
                                        id="shipment_id" :required="false" size="col-lg-6" :value="old('shipment_id')"
                                        class="" />
                                    <x-utility.forms.input label="Tracking Id" type="text" name="tracking_id"
                                        id="tracking_id" :required="false" size="col-lg-6" :value="old('tracking_id')"
                                        class="" />
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <x-utility.forms.button type="submit" label="Add" class="submit-btn" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
