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
                            <x-utility.additional.title title="Edit Review" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 mx-auto">
                    <div class="form-section">
                        <form action="{{ route('review.edit', $review->id) }}" method="POST">
                            @csrf
                            <div class="form-contents">
                                <div class="row mb-2">
                                    <x-utility.additional.form-title title="General info" size="col-lg-12" />
                                    <x-utility.forms.input label="Title" type="text" name="title" id="title"
                                        :required="true" size="col-lg-8" :value="$review->title" :readonly="true" />
                                    <div class="col-lg-8 py-2">
                                        <label for="">Rating</label>
                                        <div id="rateYo"></div>
                                    </div>
                                    <x-utility.forms.select label="Status" :options="Punjabi::getStatus()" name="status"
                                        id="status" :required="true" size="col-lg-8" :value="$review->status" />
                                    <x-utility.forms.textarea label="Description" name="description" :required="false"
                                        size="col-lg-8" :readonly="true" :value="$review->description" />
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
    @push('scripts')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
        <script>
            $(function() {
                $("#rateYo").rateYo({
                    rating: "{{ $review->rating }}",
                    readOnly: true
                });
            });
        </script>
    @endpush
</x-admin-layout>
