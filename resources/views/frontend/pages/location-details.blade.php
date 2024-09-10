<x-app-layout>
    <section class="py-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto p-3">
                    <div class="location-details">
                        <div class="row g-3">
                            <div class="col-lg-5 detail-box">
                                <div class="p-lg-4 p-3">
                                    <div class="d-flex mb-3">
                                        <span class="icof">
                                            <i class='bx bxs-cart-alt'></i>
                                        </span>
                                        <div class="">
                                            <h5 class="mt-2">{{ Punjabi::settings()?->name }}</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <span class="icof">
                                            <i class='bx bxs-phone-call'></i>
                                        </span>
                                        <div class="">
                                            <p class="mt-2">{{ Punjabi::settings()?->phone }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <span class="icof">
                                            <i class='bx bx-current-location'></i>
                                        </span>
                                        <div class="">
                                            <p class="mt-2">{{ Punjabi::settings()?->address }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <span class="icof">
                                            <i class='bx bx-time'></i>
                                        </span>
                                        <div class="">
                                            <p class="mt-2">{!! Punjabi::settings()?->working_hours !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="px-lg-3">
                                    {!! Punjabi::settings()?->map_location !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .location-details .icof {
            height: 40px;
            width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #72c23d;
            border-radius: 50%;
            color: #72c23d;
            background: white;
            margin-right: 20px;
        }

        .detail-box {
            background: #f1f1f1;
            border-radius: 10px;
        }
    </style>
</x-app-layout>
