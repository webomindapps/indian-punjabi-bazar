<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="row top_bar bg-white shadow-sm py-2">
                <div class="col-lg-10 left-area my-auto">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            {{-- <ul class="sopt">
                                <li>
                                    <a href="">
                                        <i class="fal fa-tv"></i>
                                        Electronics
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class='bx bx-fridge'></i>
                                        Appliances
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fal fa-couch"></i>
                                        Furniture
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fal fa-bed"></i>
                                        Mattresses
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fal fa-door-open"></i>
                                        Outdoor
                                    </a>
                                </li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 right-area">
                    <h6 class="me-3 pt-2">{{ auth()->user()->name }}</h6>
                    <div class="profile-icon">
                        <img src="{{ asset('frontend/assets/images/dummy-profile.png') }}" alt="">
                    </div>

                    <ul class="profile-drop" style="display: none;">
                        <li onclick="document.getElementById('logoutForm').submit()">Logout</li>
                        <form action="{{ route('admin.logout') }}" id="logoutForm" method="POST" hidden>
                            {{ csrf_field() }}
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
