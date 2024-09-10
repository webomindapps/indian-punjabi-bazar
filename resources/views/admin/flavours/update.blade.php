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
                            <x-utility.additional.title title="Update Flavour" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 mx-auto">
                    <div class="form-section">
                        <form action="{{ route('flavour.edit', $flavour->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-contents">
                                <div class="row mb-2">
                                    <x-utility.additional.form-title title="General info" size="col-lg-12" />
                                    <x-utility.forms.input label="Flavour" type="text" name="flavour" id="flavour"
                                        :required="true" size="col-lg-6" :value="$flavour->flavour" />
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
