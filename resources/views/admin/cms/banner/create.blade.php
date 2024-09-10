<x-admin-layout>
    <div class="main shadow-sm">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <x-utility.additional.title title="Add Banner" />
            </div>

            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="form-section">
                        <form action="{{ route('banner.create') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-contents">

                                <input type="hidden" name="type" value="{{ $type }}">

                                <x-utility.forms.input label="Title" type="text" name="title" id="title"
                                    size="col-lg-12" />

                                <x-utility.forms.input label="Url" type="text" name="url" id="url"
                                    size="col-lg-12" />

                                <x-utility.forms.input label="Position" type="text" name="position" id="position"
                                    size="col-lg-12" />

                                <x-utility.forms.input label="Banner" type="file" name="banner" id="banner"
                                    size="col-lg-12" :image="true" class="image-file" />
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <x-utility.forms.button type="submit" label="Add" class="btn btn-primary" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
