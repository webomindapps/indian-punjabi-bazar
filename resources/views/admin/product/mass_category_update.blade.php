<x-admin-layout>
    <div class="main shadow-sm">
        <div class="container-fluid">
            <div class="row" id="products">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <a onclick="history.length > 1 ? history.go(-1) : window.location = window.location.origin;">
                                <i class="fas fa-chevron-left fs-5"></i>
                            </a>
                            <x-utility.additional.title title="Update Products Category" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 mx-auto">
                    <div class="form-section">
                        <form method="POST" action="{{ route('mass_category_update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_ids" value="{{ $ids }}">
                            <div class="form-contents">
                                <div class="row my-2">
                                    <x-utility.additional.form-title title="Select categories" size="col-lg-12" />

                                    <x-utility.category.products.tree size="col-lg-12" :all="Punjabi::getAllCategories()" />

                                    <div class="col-lg-12">
                                        @if ($errors->has('category_id.*'))
                                            <small
                                                class="form-text text-danger">{{ $errors->first('category_id.*') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <x-utility.forms.button type="submit" label="Add" class="submit-btn" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
