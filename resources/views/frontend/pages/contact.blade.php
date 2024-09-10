<x-app-layout>
    <section class="py-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Contact Us</h1>
                </div>
            </div>
            <div class="row bg-light">
                <div class="col-lg-6 col-md-6 ">
                    <div class="contact_wrapper">
                        <h5>Hours Of Operations</h5>
                        <table>
                            <tbody>
                                <tr>
                                    <th>MON - FRI</th>
                                    <td>8:00am - 8:00pm</td>
                                </tr>
                                <tr>
                                    <th>SAT</th>
                                    <td>10:00am - 6:00pm</td>
                                </tr>
                                <tr>
                                    <th>SUN</th>
                                    <td>10:00am - 5:00pm</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="contact_wrapper pt-0">
                        <h5>Online Office</h5>
                        <address>
                            {{ $setting->address }}
                        </address>
                        <table>
                            <tbody>
                                <tr>
                                    <th>Email</th>
                                    <td>
                                        <a href="mailto:{{ $setting->contact_email }}">{{ $setting->contact_email }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tel</th>
                                    <td><a href="tel:{{ $setting->phone }}">+{{ $setting->phone }}</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 contact_wrapper_1">
                    <h4>Write Us</h4>
                    <p class="pb-2">
                        Write us a note and we’ll get back to you as quickly as possible.
                    </p>
                    <form action="{{ route('contact.us') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <div class="input-group">
                                    <label for="">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" placeholder="Name" required>
                                </div>
                                @error('name')
                                    <span style="color: red; font-size:13px;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="input-group">
                                    <label for="">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" placeholder="Email" required>
                                </div>
                                @error('email')
                                    <span style="color: red; font-size:13px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-3">
                                <div class="input-group">
                                    <label for="">Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" placeholder="Phone" minlength="10"
                                        maxlength="15" oninput="this.value = this.value.replace(/\D/g, '')"
                                        value="{{ old('phone') }}" required>
                                </div>
                                @error('phone')
                                    <span style="color: red; font-size:13px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-12 mb-3">
                                <div class="input-group">
                                    <label for="">What’s on your mind? *</label>
                                    <textarea name="message" id="" cols="30" rows="3" required></textarea>
                                </div>
                                @error('message')
                                    <span style="color: red; font-size:13px;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="btn_wrapper">
                                <button type="submit" class="view-all" style="border:none; outline:none">
                                    Submit <i class='bx bx-right-arrow-alt'></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
