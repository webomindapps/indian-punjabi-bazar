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
                            <x-utility.additional.title title="Edit News Letter Subscriber" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 mx-auto">
                    <div class="form-section">
                        <form action="{{ route('subscriber.edit', $subscriber->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-contents">
                                <div class="row mb-2">
                                    <x-utility.additional.form-title title="General info" size="col-lg-12" />
                                    <x-utility.forms.input label="Email" type="emaik" name="email" id="email"
                                        :required="true" :readonly="true" size="col-lg-6" :value="$subscriber->email" />
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Subscribed</label>
                                            <select class="form-control mt-2" name="is_subscribed">
                                                <option value="1" {{ $subscriber->is_subscribed ? 'selected' : '' }}>Subscribe
                                                </option>
                                                <option value="0" {{ $subscriber->is_subscribed ? '' : 'selected' }}>Unsubscribe
                                                </option>
                                            </select>
                                            @error('is_subscribed')
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
