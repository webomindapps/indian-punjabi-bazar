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
                            <a class="nav-link" href="{{ route('variant.value.index') }}">
                                Variant values
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row" id="variant">
                <div class="col-lg-10 mx-auto">
                    <form method="POST" action="{{ route('variant.value.store') }}">
                        @csrf
                        <div class="text-right mb-4">
                            <button class="d-none d-sm-inline-block btn btn-primary shadow-sm">Update</button>
                        </div>
                        <variant-value :variant_values="{{ $variant_values }}" :variants="{{ Punjabi::variants() }}" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
