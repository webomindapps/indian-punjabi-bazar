<x-admin-layout>
    <div class="main shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <a href=""><i class="fas fa-chevron-left fs-5"></i></a>
                            <x-utility.additional.title title="Edit Email template" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="form-section">
                        <form action="{{ route('email-template.edit', $template->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-contents">
                                <div class="row my-2">
                                    <x-utility.additional.form-title title="General info" size="col-lg-12" />
                                    <x-utility.forms.input label="Title" type="text" name="title" id="title"
                                        :required="true" size="col-lg-6" :value="$template->title" class="" />
                                    <x-utility.forms.input label="Subject" type="text" name="subject" id="subject"
                                        :required="true" size="col-lg-6" :value="$template->subject" class="" />
                                    <x-utility.forms.input label="From Email Id" type="text" name="from_id"
                                        id="from_id" :required="true" size="col-lg-6" :value="$template->from_id"
                                        class="" />
                                    <x-utility.forms.input label="From name" type="text" name="from_name"
                                        id="from_name" :required="true" size="col-lg-6" :value="$template->from_name"
                                        class="" />
                                    <x-utility.forms.input label="CC" type="text" name="cc" id="cc"
                                        :required="true" size="col-lg-12" :value="$template->cc" class="" />
                                    <x-utility.forms.textarea label="Template" name="template" id="template"
                                        :required="true" size="col-lg-12" />
                                </div>
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
