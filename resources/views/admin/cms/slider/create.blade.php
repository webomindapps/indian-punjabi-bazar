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
                            <x-utility.additional.title title="Add Slider" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="form-section">
                        <form action="{{ route('slider.create') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-contents">
                                <div class="row my-2">
                                    <x-utility.additional.form-title title="General info" size="col-lg-12" />
                                    <x-utility.forms.input label="Title" type="text" name="title" id="title"
                                        :required="true" size="col-lg-12" :value="old('title')" class="" />
                                    <x-utility.forms.input label="URL" type="text" name="url" id="url"
                                        :required="true" size="col-lg-12" :value="old('url')" class="" />
                                    <x-utility.forms.input label="Position" type="number" name="position"
                                        id="position" :required="true" size="col-lg-12" :value="old('position')"
                                        class="" />
                                    <x-utility.forms.input label="Slider" type="file" name="slider" id="slider"
                                        :required="true" size="col-lg-12" :value="old('slider')" class="" />
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
