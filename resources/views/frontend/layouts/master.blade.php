<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel=" icon" type="image/png" href="{{ asset('frontend/assets/favicon.ico') }}" sizes="32x32">
    <title> Indian Punjabi Bazaar | @yield('metaTitle', Punjabi::settings()?->meta_title)</title>
    <meta name="description" content="@yield('metaDescription', Punjabi::settings()?->meta_description)">
    <meta name="keywords" content="@yield('metaKeywords', Punjabi::settings()?->keywords)">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        referrerpolicy="no-referrer" />
    <link href="{{ asset('frontend/assets/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/flash.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('frontend/assets/magnify.css') }}" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link href="https://fonts.googleapis.com/css2family=Open+Sans&family=Roboto&display=swap" rel="stylesheet"> --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

    @vite('resources/js/app.js')

</head>

<body>
    @include('frontend.layouts.header')
    <main>
        <div class="content mt-3">
            {{ $slot }}
            @include('frontend.layouts.b_footer')
        </div>
    </main>
    <footer>
        @include('frontend.layouts.footer')
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZuRJggt3Hg37Vrl5EeL9j9FREsD7SBo8&libraries=places">
    </script>
    <script src="{{ asset('frontend/assets/flash.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/cart.js') }}"></script>
    {{-- <script src="{{ asset('frontend/assets/jquery.magnify.js') }}"></script> --}}
    <script src="{{ asset('frontend/assets/jquery.exzoom.js') }}"></script>
    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
    <link href="{{ asset('frontend/assets/jquery.exzoom.css') }}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://cdn.rawgit.com/igorlino/elevatezoom-plus/1.1.6/src/jquery.ez-plus.js">
    </script>
    @stack('scripts')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.toggle-password', function() {
                var passwordField = $(this).closest('.form-floating').find('.input-password');
                var fieldType = passwordField.attr('type');

                if (fieldType === 'password') {
                    passwordField.attr('type', 'text');
                    $(this).find('i').removeClass('bx-hide').addClass('bx-show');
                } else {
                    passwordField.attr('type', 'password');
                    $(this).find('i').removeClass('bx-show').addClass('bx-hide');
                }
            });

            // $('#search-input').on('focus', function() {
            //     $('.search-results').show();
            // })

            var searchTimer;
            $(document).on('input', '#search-input', function() {
                var searchInput = $(this).val().trim();
                if (searchInput.length < 2) {
                    $('#searched-item-List').empty();
                    $('.search-results').hide();
                    return;
                }

                clearTimeout(searchTimer);

                searchTimer = setTimeout(function() {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('search.products') }}",
                        data: {
                            search: searchInput,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            $('#searched-item-List').html(response.html);
                            $('.search-results').show();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }, 200);
            });
        });
    </script>
    @if (session('message'))
        <script>
            // toastr.success('{{ session('message') }}')
            window.FlashMessage.info('{{ session('message') }}', {
                timeout: 2000,
                progress: true
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            // toastr.error('{{ session('error') }}')
            window.FlashMessage.error('{{ session('error') }}', {
                timeout: 2000,
                progress: true
            });
        </script>
    @endif
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "900",
            "hideDuration": "900",
            "timeOut": "1000",
            "extendedTimeOut": "900",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
</body>

</html>
