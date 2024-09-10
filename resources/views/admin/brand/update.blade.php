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
                            <x-utility.additional.title title="Update Brand" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 mx-auto">
                    <div class="form-section">
                        <form action="{{ route('brand.edit', $brand->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-contents">
                                <div class="row mb-2">
                                    <x-utility.additional.form-title title="General info" size="col-lg-12" />
                                    <x-utility.forms.input label="Name" type="text" name="name" id="name"
                                        :required="true" size="col-lg-4" :value="$brand->name" />
                                    <x-utility.forms.select label="Status" :options="Punjabi::getStatus()" name="status"
                                        id="status" :required="true" size="col-lg-4" :value="$brand->status" />
                                    <x-utility.forms.input label="Image" type="file" name="image" id="image"
                                        :required="false" size="col-lg-4" :value="old('image')" :image="true"
                                        :imageValue="asset($brand->image)" />

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
