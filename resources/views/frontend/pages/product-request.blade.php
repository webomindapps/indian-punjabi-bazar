<x-app-layout>
    <div class="container-fluid py-4 bg-light">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="border rounded p-4">
                    <p class="mb-5">If you are still failing to find the product or brand that you are
                        looking for, kindly fill out the form
                        that is provided below. The purchasing department of our company will look over this
                        information and do all in our power to fulfill your request for a unique order.</p>
                    <form action="{{ route('product.request') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="">
                                    <label class="form-label" for="first_name">First Name : *</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name"
                                        value="{{ old('first_name') }}" required>
                                    @error('first_name')
                                        <span style="font-size:13px;color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label class="form-label" for="last_name">Last Name : *</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name"
                                        value="{{ old('last_name') }}" required>
                                    @error('last_name')
                                        <span style="font-size:13px;color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label class="form-label" for="email">Email : *</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <span style="font-size:13px;color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label class="form-label" for="phone">Telephone : *</label>
                                    <input type="text" name="phone" class="form-control" id="phone"
                                        minlength="10" maxlength="15"
                                        oninput="this.value = this.value.replace(/\D/g, '')"
                                        value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <span style="font-size:13px;color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label class="form-label" for="brand">Brand : *</label>
                                    <input type="text" name="brand" class="form-control" id="brand"
                                        value="{{ old('brand') }}" required>
                                    @error('brand')
                                        <span style="font-size:13px;color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label class="form-label" for="product">Product : *</label>
                                    <input type="text" name="product" class="form-control" id="product"
                                        value="{{ old('product') }}" required>
                                    @error('product')
                                        <span style="font-size:13px;color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="">
                                    <label class="form-label" for="resume">
                                        If you have the image of the product you are looking for
                                    </label>
                                    <input type="file" name="image" id="image" accept=".jpg,.png,.webp"
                                        class="form-control">
                                    @error('image')
                                        <span style="font-size:13px;color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="">
                                    <label class="form-label" for="resume">Comments</label>
                                    <textarea name="message" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-center">
                                    <button type="submit" style="background: #93c572;color:#fff;" class="btn">
                                        Submit Request
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
