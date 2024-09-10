<x-admin-layout>
    <div class="main shadow-sm" style="overflow: hidden;">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header px-0">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <h3>Banners</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-lg-10 mx-auto">
                    <div class="form-section">
                        <div class="form-contents">
                            <div class="row my-2">
                                <x-utility.additional.form-title title="Single Banner" size="col-lg-11" />
                                <div class="col-lg-1">
                                    <a href="{{ route('banner.create', ['type' => 1]) }}"
                                        class="d-none d-sm-inline-block btn btn-primary shadow-sm">Add</a>
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($banners['type_1'] as $banner)
                                    <div class="col-12">
                                        <div class="banner-image-section position-relative"
                                            style="height: 200px;overflow:hidden;">
                                            <a onclick="return confirm('Are you sure you want to delete this?')"
                                                href="{{ route('banner.destroy', $banner->id) }}"
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1">
                                                <i class='bx bxs-trash text-white'></i>
                                            </a>
                                            <img src="{{ asset("storage/$banner->banner_image_path") }}"
                                                class="img-fluid w-100" height="100px">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-lg-10 mx-auto">
                    <div class="form-section">
                        <div class="form-contents">
                            <div class="row mb-2">
                                <x-utility.additional.form-title title="Two Banner" size="col-lg-11" />
                                <div class="col-lg-1">
                                    <a href="{{ route('banner.create', ['type' => 2]) }}"
                                        class="d-none d-sm-inline-block btn btn-primary shadow-sm">Add</a>
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($banners['type_2'] as $banner)
                                    <div class="col-6">
                                        <div class="banner-image-section position-relative"
                                            style="height: 250px;overflow:hidden;">
                                            <a onclick="return confirm('Are you sure you want to delete this?')"
                                                href="{{ route('banner.destroy', $banner->id) }}"
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1">
                                                <i class='bx bxs-trash text-white'></i>
                                            </a>
                                            <img src="{{ asset("storage/$banner->banner_image_path") }}"
                                                class="img-fluid w-100" height="100px">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-lg-10 mx-auto">
                    <div class="form-section">
                        <div class="form-contents">
                            <div class="row mb-2">
                                <x-utility.additional.form-title title="Three Banner" size="col-lg-11" />
                                <div class="col-lg-1">
                                    <a href="{{ route('banner.create', ['type' => 3]) }}"
                                        class="d-none d-sm-inline-block btn btn-primary shadow-sm">Add</a>
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($banners['type_3'] as $banner)
                                    <div class="col-4">
                                        <div class="banner-image-section position-relative"
                                            style="height: 250px;overflow:hidden;">
                                            <a onclick="return confirm('Are you sure you want to delete this?')"
                                                href="{{ route('banner.destroy', $banner->id) }}"
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1">
                                                <i class='bx bxs-trash text-white'></i>
                                            </a>
                                            <img src="{{ asset("storage/$banner->banner_image_path") }}"
                                                class="img-fluid w-100" height="100px">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
