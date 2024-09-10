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
                            <x-utility.additional.title title="Update Slider" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="form-section">
                        <form action="{{ route('slider.edit', $slider->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-contents">
                                <div class="row my-2">
                                    <x-utility.additional.form-title title="General info" size="col-lg-12" />
                                    <x-utility.forms.input label="Title" type="text" name="title" id="title"
                                        :required="true" size="col-lg-12" :value="$slider->title" class="" />
                                    <x-utility.forms.input label="URL" type="text" name="url" id="url"
                                        :required="true" size="col-lg-12" :value="$slider->url" class="" />
                                    <x-utility.forms.input label="Position" type="number" name="position"
                                        id="position" :required="true" size="col-lg-12" :value="$slider->position"
                                        class="" />
                                    <x-utility.forms.input label="Slider" type="file" name="slider" id="slider"
                                        :required="false" size="col-lg-12" :value="$slider->slider_path" class="" />
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
