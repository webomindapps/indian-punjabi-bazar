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
                            <x-utility.additional.title title="Update Page" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="form-section">
                        <form action="{{ route('page.edit', $page->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-contents">
                                <div class="row my-2">
                                    <x-utility.additional.form-title title="General info" size="col-lg-12" />
                                    <x-utility.forms.input label="Name" type="text" name="name" id="name"
                                        :required="true" size="col-lg-6" value="{!! $page->name !!}"
                                        class="" />
                                    <x-utility.forms.input label="Position" type="number" name="position"
                                        id="position" :required="true" size="col-lg-6" :value="$page->position"
                                        class="" />
                                    <x-utility.forms.input label="Title of description" type="text" name="title"
                                        id="title" :required="true" size="col-lg-12"
                                        value="{!! $page->title !!}" class="" />
                                    <x-utility.forms.textarea label="Description" name="description" id="description"
                                        :required="true" value="{!! $page->description !!}" size="col-lg-12" />
                                </div>
                                <x-utility.additional.seo-form title="{!! $page->meta_title !!}" :description="$page->meta_description"
                                    :keywords="$page->meta_keywords" />
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
