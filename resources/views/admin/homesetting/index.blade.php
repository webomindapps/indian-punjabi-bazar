<x-admin-layout>
    <div class="main shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <x-utility.additional.title title="Home Setting" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 mx-auto">
                    <div class="form-section mt-3">
                        <form action="{{ route('home.setting') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-contents">
                                <div class="row mb-2">
                                    <x-utility.additional.form-title title="Settings" size="col-lg-12" />
                                    <x-utility.forms.input label="Name" type="text" name="name" id="name"
                                        :required="true" size="col-lg-6" :value="$setting->name" />
                                    <x-utility.forms.input label="Contact Email" type="text" name="contact_email"
                                        id="contact_email" :required="true" size="col-lg-6" :value="$setting->contact_email" />
                                    <x-utility.forms.input label="Phone" type="text" name="phone" id="phone"
                                        :required="true" size="col-lg-6" :value="$setting->phone" />
                                    <x-utility.forms.input label="Logo" type="file" name="logo" id="logo"
                                        :required="false" size="col-lg-6" :value="$setting->logo" />
                                    <x-utility.forms.input label="Admin Emails" type="text" name="admin_mails"
                                        id="admin_mails" :required="true" size="col-lg-12" :value="$setting->admin_mails" />
                                    <x-utility.forms.textarea label="Address" name="address" id="address"
                                        :required="false" size="col-lg-12" :value="$setting->address" />
                                    <x-utility.forms.input label="Fax" type="text" name="fax" id="fax"
                                        :required="false" size="col-lg-12" :value="$setting->fax" />
                                    <x-utility.forms.textarea label="Map Location" name="map_location" id="map_location"
                                        :required="false" size="col-lg-12" :value="$setting->map_location" />
                                    <x-utility.forms.textarea label="Working Hours" name="working_hours" id="description"
                                        :required="false" size="col-lg-12" :value="$setting->working_hours" />
                                    <x-utility.forms.input label="Meta Title" type="text" name="meta_title"
                                        id="meta_title" :required="false" size="col-lg-12" :value="$setting->meta_title" />
                                    <x-utility.forms.textarea label="Meta Description" name="meta_description"
                                        id="meta_description" :required="false" size="col-lg-12" :value="$setting->meta_description" />
                                    <x-utility.forms.textarea label="Keywords" name="keywords" id="keywords"
                                        :required="false" size="col-lg-12" :value="$setting->keywords" />
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
