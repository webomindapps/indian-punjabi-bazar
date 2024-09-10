<x-admin-layout>
    <div class="main">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <div>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('variants') }}">Variant</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('variant.value.index')}}">
                                Variant values
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row" id="variant">
                <div class="col-lg-10 mx-auto">
                    <form method="POST" action="{{ route('variant.store') }}">
                        @csrf
                        <div class="text-right mb-4">
                            <button class="d-none d-sm-inline-block btn btn-primary shadow-sm">Update</button>
                        </div>
                        <variant :variants="{{ $variants }}" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        th{
            padding: 3px 5px;
        }
    </style>
</x-admin-layout>
@push('scripts')
    <script type="text/javascript" src="{{ asset('assets/js/setting.js') }}"></script>
@endpush
