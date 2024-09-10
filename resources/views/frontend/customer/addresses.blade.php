<x-app-layout>
    <x-customer-profile>
        <div class="add_box">
            <div class="d-flex justify-content-between mb-3">
                <!-- heading -->
                <h3 class="mb-0">Address</h3>
                <!-- button -->
                <a href="{{ route('create.address') }}" class="btn btn-outline-primary">
                    Add address <i class='bx bx-edit-alt'></i>
                </a>
            </div>
            <hr>
            <div class="row">
                <!-- col -->
                @foreach ($customer->addresses as $address)
                    <div class="col-lg-5 col-xxl-4 col-12 mb-4">
                        <!-- form -->
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="homeRadio" checked="">
                                    <label class="form-check-label text-dark fw-semibold" for="homeRadio">Home</label>
                                </div>
                                <!-- address -->
                                <p class="mb-6">
                                    {{ $address->address }}
                                    <br>
                                    {{ $address->city }}
                                    <br>
                                    {{ $address->state }}
                                    <br>
                                    {{ $address->pincode }}
                                </p>
                                <!-- btn -->
                                <a href="#" class="btn view-all btn-sm">Default address</a>
                                <div class="mt-4">
                                    <a href="#" class="text-inherit">Edit</a>
                                    <a href="#" class="text-danger ms-3" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-customer-profile>
</x-app-layout>
