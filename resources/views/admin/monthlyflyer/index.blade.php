<x-admin-layout>
    <div class="main shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <x-utility.additional.title title="Monthly Flyer" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 mx-auto">
                    <div class="form-section mt-3">
                        <form action="{{ route('monthlyflyer') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-contents">
                                <div class="row mb-2">
                                    <x-utility.additional.form-title title="Monthly Flyer" size="col-lg-12" />
                                    @if (!is_null($flyer))
                                        <a class="px-3 py-2 border col-lg-8 text-danger"
                                            style="text-decoration: none;background:rgb(189, 189, 189);"
                                            href="{{ asset($flyer->file) }}" download>{{ $flyer->title }}</a>
                                    @endif
                                    <x-utility.forms.input label="Title" type="text" name="title" id="title"
                                        :required="true" size="col-lg-8" :value="$flyer?->title" />
                                    <x-utility.forms.input label="Upload File" type="file" name="file"
                                        id="file" :required="false" size="col-lg-8" :value="$flyer?->file" />
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
