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
                            <x-utility.additional.title title="Edit Customer" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 mx-auto">
                    <div class="form-section">
                        <form action="{{ route('customer.edit', $customer->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-contents">
                                <div class="row mb-2">
                                    <x-utility.additional.form-title title="General info" size="col-lg-12" />
                                    <x-utility.forms.input label="First Name" type="text" name="first_name"
                                        id="first_name" :required="true" size="col-lg-6" :value="$customer->first_name" />
                                    <x-utility.forms.input label="Last Name" type="text" name="last_name"
                                        id="first_name" :required="true" size="col-lg-6" :value="$customer->last_name" />
                                    <x-utility.forms.input label="Email" type="email" name="email" id="email"
                                        :required="true" size="col-lg-6" :value="$customer->email" :readonly="true" />
                                    <x-utility.forms.input label="Phone" type="text" name="phone" id="phone"
                                        :required="true" size="col-lg-6" :value="$customer->phone" />
                                    <x-utility.forms.input label="Date of Birth" type="date" name="dob"
                                        id="dob" :required="false" size="col-lg-6" :value="$customer->dob" />
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control mt-2" name="gender">
                                                <option value="">Select Gender</option>
                                                <option {{ $customer->gender == 'Male' ? 'selected' : '' }}>Male
                                                </option>
                                                <option {{ $customer->gender == 'Female' ? 'selected' : '' }}>Female
                                                </option>
                                                <option {{ $customer->gender == 'Others' ? 'selected' : '' }}>Others
                                                </option>
                                            </select>
                                            @error('gender')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
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
