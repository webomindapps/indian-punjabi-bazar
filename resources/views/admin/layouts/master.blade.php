<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indian Punjabi Bazaar | Admin Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link defer rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @stack('styles')
    @vite('resources/js/app.js')
</head>

<body>


    {{-- Side bar --}}
    @include('admin.layouts.sidebar')
    <div class="home_content">
        @include('admin.layouts.topbar')
        {{ $slot }}
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="main.js"></script>

    <script>
        $(document).ready(function() {
            $(".profile-icon").click(function() {
                $(".profile-drop").toggle();
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let btn = document.querySelector("#btn");
            let sidebar = document.querySelector(".sidebar");
            let dropdownLinks = document.querySelectorAll(".dropdown");

            btn.onclick = function() {
                sidebar.classList.toggle("active");
            }

            dropdownLinks.forEach(link => {
                link.addEventListener("click", function(e) {

                    let dropdownMenu = this.querySelector(".dropdown_menu");
                    dropdownMenu.classList.toggle("open");
                });
            });
        });
    </script>
    <script>
        $('.slug').on('keyup', function() {
            var val = $(this).val();
            var slug = val.replace(/\s+/g, "-");
            $('#slug').val(slug.toLowerCase());
        });
    </script>
    <script src="https://cdn.tiny.cloud/1/8rw6v89bjqiokx3j9ri1i9d5yy2lpm1hu92j7bpldea0gxp8/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#description,#template,#how_to_use,#ingredients,#disclaimer'
        });
    </script>
    @stack('scripts')
    @if (session('message'))
        <script>
            toastr.success('{{ session('message') }}')
        </script>
    @endif
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}')
        </script>
    @endif
    @if (session('error'))
        <script>
            toastr.error('{{ session('error') }}')
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
