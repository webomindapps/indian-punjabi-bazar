<x-app-layout>
    <div class="container secs">
        <div class="mx-auto col-lg-5 col-md-11 rounded shadow">
            <div class="login_box">
                <h2 class="text-center text-green fw-bold mb-4">Login to your account</h2>
                <form action="{{ route('customer.login') }}" method="POST">
                    @csrf
                    @if (session('danger'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('danger') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('verify'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('verify') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="floatingInput"
                            placeholder="name@example.com" value="{{ old('email') }}">
                        <label for="floatingInput">Email address</label>
                    </div>
                    @error('email')
                        <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                    @enderror
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control input-password" id="floatingPassword"
                            placeholder="Password">
                        <label for="floatingPassword">Password</label>
                        <span class="login-pass toggle-password"><i class='bx bx-hide'></i></span>
                    </div>
                    @error('password')
                        <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                    @enderror
                    <div class="col-sm-12 mb-3">
                        <div class="row">
                            <div class="col-6">
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{ route('customer.forget.password') }}">
                                    <i class='bx bx-help-circle'></i> Forgot password?
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto text-center">
                        <button type="submit" class="btn view-all my-3">Login </button>
                    </div>
                </form>
                <hr>

                <div class="col-md-11 pt-3 mx-auto">
                    <a href="{{ route('google.redirect') }}" class="sign-up view-all d-block"
                        style="background:#db4437">
                        <i class='bx bxl-google me-1'></i> Sign in with <b>Google</b>
                    </a>

                    <p class="text-center mt-4 mb-0">Don’t have account?
                        <a href="{{ route('customer.register') }}">Please create/register a account here.</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
