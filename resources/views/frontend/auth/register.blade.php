<x-app-layout>
    <div class="container secs">
        <div class="mx-auto col-lg-5 col-md-11 rounded shadow">
            <div class="login_box">
                <h2 class="text-center text-green fw-bold mb-4">Register your account</h2>
                <form action="{{ route('customer.register') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="First name" name="first_name"
                                    id="floatingInputName" aria-label="First name" value="{{ old('first_name') }}">
                                <label for="floatingInputName">First name</label>
                                @error('first_name')
                                    <span style="font-size:12px;color:red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="Last name" name="last_name"
                                    id="floatingInputLName" aria-label="First name" value="{{ old('last_name') }}">
                                <label for="floatingInputLName">Last name</label>
                                @error('last_name')
                                    <span style="font-size:12px;color:red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" name="email"
                            placeholder="name@example.com" value="{{ old('email') }}">
                        <label for="floatingInput">Email address</label>
                        @error('email')
                            <span style="font-size:12px;color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control input-password" name="password"
                            placeholder="Password">
                        <label for="floatingPassword">Password</label>
                        <span class="login-pass toggle-password"><i class='bx bx-hide'></i></span>
                        @error('password')
                            <span style="font-size:12px;color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control input-password" name="conf_password"
                            placeholder="Password">
                        <label for="floatingPassword">Confirm password</label>
                        <span class="login-pass toggle-password"><i class='bx bx-hide'></i></span>
                        @error('conf_password')
                            <span style="font-size:12px;color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-auto text-center">
                        <button type="submit" class="btn view-all my-3">Register Account </button>
                    </div>
                </form>
                <hr>

                <div class="col-md-11 pt-3 mx-auto">
                    {{-- <a href="" class="sign-up view-all d-block" style="background:#db4437">
                        <i class='bx bxl-google me-1'></i> Sign up with <b>Google</b>
                    </a> --}}

                    <p class="text-center mt-4 mb-0">Already have an account? <a href="{{route('customer.login')}}"> Login</a></p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
