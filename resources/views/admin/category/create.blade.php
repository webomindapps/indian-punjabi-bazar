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
                            <x-utility.additional.title title="Add Category" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 pb-4">
                    <div class="form-card px-3">
                        <form action="{{ route('category.create') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-contents">
                                <div class="row mb-2">
                                    <x-utility.additional.form-title title="General Info" size="col-lg-12" />
                                    <x-utility.forms.input label="Name" type="text" name="name" id="name"
                                        :required="true" size="col-lg-4" :value="old('name')" class="slug" />

                                    <x-utility.forms.input label="Position" type="text" name="position"
                                        id="position" :required="true" size="col-lg-4" :value="old('position')" />

                                    <x-utility.forms.input label="Slug" type="text" name="slug" id="slug"
                                        :required="true" size="col-lg-4" :value="old('slug')" :readonly="true" />

                                    <x-utility.category.tree size="col-lg-12" :all="Punjabi::getAllCategories()" />

                                </div>
                            </div>

                            <x-utility.additional.seo-form />

                            <div class="form-contents">
                                <div class="row mb-2">
                                    <x-utility.additional.form-title title="Others" size="col-lg-12" />

                                    <x-utility.forms.select label="Status" :options="Punjabi::getStatus()" name="status"
                                        id="status" :required="true" size="col-lg-12" :value="old('status')" />

                                    <x-utility.forms.textarea label="Description" name="description" id="description"
                                        :required="false" size="col-lg-12" :value="old('description')" />

                                    <x-utility.forms.input label="Icon" type="file" name="icon" id="icon"
                                        :required="false" size="col-lg-6" :value="old('icon')" :image="true"
                                        class="image-file" />

                                    <x-utility.forms.input label="Image" type="file" name="image" id="image"
                                        :required="false" size="col-lg-6" :value="old('image')" :image="true"
                                        class="image-file" />
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
