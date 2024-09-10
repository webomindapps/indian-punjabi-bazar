<x-app-layout>
    <div class="container-fluid py-4 bg-light">
        <h3 class="text-center mb-3">Start you Career with us</h3>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="border rounded p-4">
                    <form action="{{ route('career') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="">
                                    <label class="form-label" for="first_name">First Name : *</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name"
                                        value="{{ old('first_name') }}">
                                    @error('first_name')
                                        <span style="font-size:13px;color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label class="form-label" for="last_name">Last Name : *</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name" value="{{ old('last_name') }}">
                                    @error('last_name')
                                        <span style="font-size:13px;color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label class="form-label" for="email">Email : *</label>
                                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
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
                                        oninput="this.value = this.value.replace(/\D/g, '')" value="{{ old('phone') }}">
                                    @error('phone')
                                        <span style="font-size:13px;color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label class="form-label" for="phone">Status in Canada : *</label>
                                    <select name="status" class="form-select">
                                        <option>CITIZEN</option>
                                        <option>PERMANENT RESIDENCE</option>
                                        <option>WORK PERMIT</option>
                                        <option>STUDENT (study permit)</option>
                                        <option>STUDENT (under 18)</option>
                                        <option>OTHER</option>
                                    </select>
                                    @error('status')
                                        <span style="font-size:13px;color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label class="form-label" for="phone">Positions *</label>
                                    <select name="position" class="form-select">
                                        <option>Cashier</option>
                                        <option>General Labour</option>
                                        <option>Restaurant</option>
                                        <option>Others</option>
                                    </select>
                                    @error('position')
                                        <span style="font-size:13px;color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="">
                                    <label class="form-label" for="dob">Date of birth : *</label>
                                    <input type="date" name="dob" class="form-control" id="dob" value="{{ old('dob') }}" max="{{date('Y-m-d')}}">
                                    @error('dob')
                                        <span style="font-size:13px;color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="">
                                    <label class="form-label" for="address">Address :*</label>
                                    <input type="text" name="address" class="form-control" id="address" value="{{ old('address') }}">
                                    @error('address')
                                        <span style="font-size:13px;color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <label class="form-label" for="city">City : *</label>
                                    <input type="text" name="city" class="form-control" id="city" value="{{ old('city') }}">
                                    @error('address')
                                        <span style="font-size:13px;color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <label class="form-label" for="province">Province : *</label>
                                    <input type="text" name="province" class="form-control" id="province" value="{{ old('province') }}">
                                    @error('province')
                                        <span style="font-size:13px;color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <label class="form-label" for="pincode">Pincode : *</label>
                                    <input type="text" name="pincode" class="form-control" id="pincode" value="{{ old('pincode') }}">
                                    @error('pincode')
                                        <span style="font-size:13px;color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Availability : *</label>
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center">
                                        <tr>
                                            <th></th>
                                            <th>Monday</th>
                                            <th>Tuesday</th>
                                            <th>Wednesday</th>
                                            <th>Thursday</th>
                                            <th>Friday</th>
                                            <th>Saturday</th>
                                            <th>Sunday</th>
                                        </tr>
                                        <tr>
                                            <th>
                                                Am
                                            </th>
                                            <td>
                                                <input type="checkbox" class="form-check-input" name="availability[]"
                                                    value="Mon Am">
                                            </td>
                                            <td>
                                                <input type="checkbox" class="form-check-input" name="availability[]"
                                                    value="Tue Am">
                                            </td>
                                            <td>
                                                <input type="checkbox" class="form-check-input" name="availability[]"
                                                    value="Wed Am">
                                            </td>
                                            <td>
                                                <input type="checkbox" class="form-check-input" name="availability[]"
                                                    value="Thu Am">
                                            </td>
                                            <td>
                                                <input type="checkbox" class="form-check-input" name="availability[]"
                                                    value="Fri Am">
                                            </td>
                                            <td>
                                                <input type="checkbox" class="form-check-input" name="availability[]"
                                                    value="Sat Am">
                                            </td>
                                            <td>
                                                <input type="checkbox" class="form-check-input" name="availability[]"
                                                    value="Sun Am">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Pm
                                            </th>
                                            <td>
                                                <input type="checkbox" class="form-check-input" name="availability[]"
                                                    value="Mon Pm">
                                            </td>
                                            <td>
                                                <input type="checkbox" class="form-check-input" name="availability[]"
                                                    value="Tue Pm">
                                            </td>
                                            <td>
                                                <input type="checkbox" class="form-check-input" name="availability[]"
                                                    value="Wed Pm">
                                            </td>
                                            <td>
                                                <input type="checkbox" class="form-check-input" name="availability[]"
                                                    value="Thu Pm">
                                            </td>
                                            <td>
                                                <input type="checkbox" class="form-check-input" name="availability[]"
                                                    value="Fri Pm">
                                            </td>
                                            <td>
                                                <input type="checkbox" class="form-check-input" name="availability[]"
                                                    value="Sat Pm">
                                            </td>
                                            <td>
                                                <input type="checkbox" class="form-check-input" name="availability[]"
                                                    value="Sun Pm">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="">
                                    <label class="form-label" for="resume">Upload resume (max-size 2mb | File
                                        type: pdf, doc)
                                        *</label>
                                    <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx"
                                        class="form-control">
                                    @error('resume')
                                        <span style="font-size:13px;color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="">
                                    <label class="form-label" for="resume">Comments</label>
                                    <textarea name="comments" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-center">
                                    <button type="submit" style="background: #93c572;color:#fff;"
                                        class="btn">Submit
                                        Application</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
