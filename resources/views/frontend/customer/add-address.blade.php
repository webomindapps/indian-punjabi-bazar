<x-app-layout>
    <x-customer-profile>
        <div class="add_box">
            <div class="d-flex justify-content-between mb-3">
                <h3 class="mb-0">Add Address</h3>
            </div>
            <hr>
            <form action="{{ route('create.address') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="First name" name="first_name"
                                aria-label="First name">
                            <label for="floatingInputName">First name *</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="last_name" placeholder="Last name"
                                id="floatingInputLName" aria-label="First name">
                            <label for="floatingInputLName">Last name *</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="floatingInput"
                                placeholder="name@example.com">
                            <label for="floatingInput">Email *</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="tel" class="form-control" id="floatingphone"
                                placeholder="Enter phone number" name="phone">
                            <label for="floatingphone">Phone *</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="State" id="floatingInputState"
                                name="state">
                            <label for="floatingInputState">State *</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="State" id="floatingInputCity"
                                aria-label="City" name="city">
                            <label for="floatingInputCity">City *</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <input type="text" id="floatingInputZip" class="form-control" placeholder="Pin code"
                                name="pincode">
                            <label for="floatingInputZip">Pin Code *</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <textarea id="floatingInputAddress" name="address" class="form-control" placeholder="Address goes here" style="height: 100px"></textarea>
                            <label for="floatingInputAddress">Address</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-outline-primary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </x-customer-profile>
</x-app-layout>
