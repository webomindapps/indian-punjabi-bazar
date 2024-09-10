<x-app-layout>
    <section class="py-lg-5">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <a href="{{ route('location.details') }}">
                            <div class="p-3 location-card">
                                <h5 class="text-center font-bold" style="color:#72c23d;">{{ Punjabi::settings()?->name }}
                                </h5>
                                <p><strong>Address:</strong> {{ Punjabi::settings()?->address }}</p>
                                <p><strong>Phone:</strong> {{ Punjabi::settings()?->phone }}</p>
                                <p><strong>Email:</strong> {{ Punjabi::settings()?->contact_email }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .location-card {
            border-radius: 5px;
            border: 1px solid rgba(208, 208, 208, 0.932);
        }

        a:hover p {
            color: black !important;
        }

        a:hover .location-card {
            border: 1px solid #72c23d;
        }
    </style>
</x-app-layout>
