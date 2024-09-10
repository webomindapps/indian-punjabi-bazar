<x-app-layout>
    <x-customer-profile>
        <div class="add_box">
            <h3>My account details</h3>
            <hr>
            <div class="row">
                <div class="col-lg-5">
                    <!-- form -->
                    <form action="{{ route('customer.update.profile') }}" method="POST">
                        @csrf
                        <!-- input -->
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control"
                                value="{{ $customer->first_name }}" placeholder="First Name">
                            @error('first_name')
                                <span style="font-size: 13px;color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control"
                                value="{{ $customer->last_name }}" placeholder="Last Name">
                            @error('last_name')
                                <span style="font-size: 13px;color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- input -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $customer->email }}"
                                placeholder="example@gmail.com">
                            @error('email')
                                <span style="font-size: 13px;color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- input -->
                        <div class="mb-4">
                            <label class="form-label">Phone</label>
                            <input type="text" inputmode="numeric" name="phone" maxlength="15"
                                oninput="this.value = this.value.replace(/\D/g, '')" class="form-control"
                                value="{{ $customer->phone }}" placeholder="Phone number">
                            @error('phone')
                                <span style="font-size: 13px;color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- button -->
                        <div class="mb-3">
                            <button type="submit" class="btn view-all">Save Details</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="my-5">
            <div class="pe-lg-14">
                <!-- heading -->
                <h3 class="mb-4">Password</h3>
                <form method="post" action="{{ route('customer.reset.password') }}"
                    class="row row-cols-1 row-cols-lg-2">
                    @csrf
                    <!-- input -->
                    <div class="mb-3 col">
                        <label class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control" placeholder="**********">
                        @error('new_password')
                            <span style="font-size: 13px;color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- input -->
                    <div class="mb-3 col">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="conf_password" class="form-control" placeholder="**********">
                        @error('conf_password')
                            <span style="font-size: 13px;color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- input -->
                    <div class="col-12">
                        <p class="mb-4 d-none">
                            Can’t remember your current password?
                            <a href="#">Reset your password.</a>
                        </p>
                        <button type="submit" class="btn view-all">Save Password</button>
                    </div>
                </form>
            </div>
            {{-- <hr class="my-5">
            <div>
                <!-- heading -->
                <h3 class="mb-4">Delete Account</h3>
                <p class="mb-2">Would you like to delete your account?</p>
                <p class="mb-5">This account contain 12 orders, Deleting your account will remove all the
                    order details associated with it.</p>
                <!-- btn -->
                <a href="#" class="btn btn-outline-danger">I want to delete my account</a>
            </div> --}}
        </div>
    </x-customer-profile>
</x-app-layout>
