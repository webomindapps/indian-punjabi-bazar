<x-app-layout>

    @include('frontend.pages.sections.sliders')
    @include('frontend.pages.sections.categories')
    @include('frontend.pages.sections.featured-product')
    @include('frontend.pages.sections.single-offer')
    @include('frontend.pages.sections.bestseller')

    {{-- @include('frontend.pages.sections.health-goals') --}}
    @include('frontend.pages.sections.three-offers')
    @include('frontend.pages.sections.new-lunches')
    {{-- @include('frontend.pages.sections.single-offer') --}}
    {{-- @include('frontend.pages.sections.brands') --}}
    @push('scripts')
        <script>
            $('.owl-carousel.owl-one').owlCarousel({
                loop: true,
                margin: 0,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                navText: ["<i class='bx bx-left-arrow-alt'></i>", "<i class='bx bx-right-arrow-alt'></i>"],
                responsive: {
                    0: {
                        items: 3
                    },
                    600: {
                        items: 3
                    },
                    700: {
                        items: 4
                    },
                    1000: {
                        items: 7
                    },
                    1600: {
                        items: 8
                    },
                    1700: {
                        items: 9
                    }
                }
            });
            $('.owl-carousel.owl-two').owlCarousel({
                loop: true,
                margin: 0,
                nav: true,
                dots: false,
                navText: ["<i class='bx bx-left-arrow-alt'></i>", "<i class='bx bx-right-arrow-alt'></i>"],
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    700: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    },
                    1280: {
                        items: 5
                    },
                    1400: {
                        items: 6
                    },
                    1600: {
                        items: 6
                    },
                    1800: {
                        items: 7
                    }
                }
            });
            $('.owl-carousel.owl-three').owlCarousel({
                loop: false,
                margin: 15,
                nav: true,
                dots: false,
                navText: ["<i class='bx bx-left-arrow-alt'></i>", "<i class='bx bx-right-arrow-alt'></i>"],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 5
                    },
                    1600: {
                        items: 6
                    },
                    1700: {
                        items: 7
                    }
                }
            })
            $('#banner').owlCarousel({
                loop: true,
                margin: 15,
                nav: true,
                dots: false,
                navText: ["<i class='bx bx-left-arrow-alt'></i>", "<i class='bx bx-right-arrow-alt'></i>"],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    },
                    1600: {
                        items: 1
                    },
                    1700: {
                        items: 1
                    }
                }
            })
            $('.owl-carousel.owl-health').owlCarousel({
                loop: true,
                margin: 0,
                nav: true,
                dots: false,
                navText: ["<i class='bx bx-left-arrow-alt'></i>", "<i class='bx bx-right-arrow-alt'></i>"],
                responsive: {
                    0: {
                        items: 3
                    },
                    600: {
                        items: 3
                    },
                    700: {
                        items: 4
                    },
                    1000: {
                        items: 5
                    },
                    1280: {
                        items: 6
                    },
                    1400: {
                        items: 8
                    },
                    1600: {
                        items: 9
                    },
                    1800: {
                        items: 9
                    }
                }
            });
        </script>
    @endpush
</x-app-layout>
