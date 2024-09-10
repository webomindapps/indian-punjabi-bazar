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
                            <x-utility.additional.title title="Update Coupon" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="form-section">
                        <form action="{{ route('coupon.edit', $coupon->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-contents">
                                <div class="row my-2">
                                    <x-utility.additional.form-title title="General info" size="col-lg-12" />
                                    <x-utility.forms.input label="Name" type="text" name="name" id="name"
                                        :required="true" size="col-lg-6" :value="$coupon->name" class="slug" />
                                    <x-utility.forms.select label="Status" :options="Punjabi::getStatus()" name="status"
                                        id="status" :required="true" size="col-lg-6" :value="$coupon->status" />

                                    <x-utility.forms.textarea label="Description" name="description" :required="false"
                                        size="col-lg-12" :value="$coupon->description" />

                                    <x-utility.forms.input label="From date" type="date" name="from"
                                        id="from" :required="true" size="col-lg-6" :value="$coupon->from" />

                                    <x-utility.forms.input label="To date" type="date" name="to" id="to"
                                        :required="true" size="col-lg-6" :value="$coupon->to" />

                                    <x-utility.forms.select label="Discount type" :options="[
                                        ['label' => 'Percentage', 'value' => 1],
                                        ['label' => 'Fixed Amount', 'value' => 2],
                                    ]"
                                        name="discount_type" id="discount_type" :required="true" size="col-lg-6"
                                        :value="$coupon->discount_type" />

                                    <x-utility.forms.input label="Discount type value" type="number"
                                        name="discount_type_value" id="discount_type_value" :required="true"
                                        size="col-lg-6" :value="$coupon->discount_type_value" class="slug" />


                                    <x-utility.forms.select label="Is condition for discount" :options="[['label' => 'Yes', 'value' => 1], ['label' => 'No', 'value' => 0]]"
                                        name="is_condition_coupon" id="is_condition_coupon" :required="true"
                                        size="col-lg-12" :value="$coupon->is_condition_coupon" />

                                    <x-utility.forms.input label="Minimum amount for discount" type="number"
                                        name="min_amount_for_discount" id="discount_type_value" :required="true"
                                        size="col-lg-6" :value="$coupon->min_amount_for_discount" />

                                    <x-utility.forms.input label="Max discount amount" type="number"
                                        name="max_discount_amount" id="max_discount_amount" :required="true"
                                        size="col-lg-6" :value="$coupon->max_discount_amount" />
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
