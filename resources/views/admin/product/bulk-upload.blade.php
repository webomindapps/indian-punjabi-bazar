<x-admin-layout>
    <div class="main shadow-sm">
        <div class="container-fluid">
            <div class="row" id="products">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <x-utility.additional.title title="Product Bulk-upload" />
                        </div>
                        <div class="col-lg-8">
                            <a href="{{ asset('assets/Punjabi.xlsx') }}" class="btn btn-info float-end text-white">
                                Download Sample
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 mx-auto">
                    <div class="form-section">
                        <form method="POST" action="{{ route('products.bulk.upload') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-contents">
                                <div class="row my-2">
                                    <x-utility.forms.input label="XLS/XLSX file" type="file" name="excel"
                                        id="name" :required="true" size="col-lg-6" :value="old('excel')"
                                        class="" />
                                    <x-utility.forms.input label="Image Zip file" type="file" name="imageZip"
                                        id="name" :required="false" size="col-lg-6" :value="old('name')"
                                        class="" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <x-utility.forms.button type="submit" label="Import" class="submit-btn" />
                                </div>
                            </div>
                        </form>
                        <form method="POST" class="d-none" action="{{ route('bulk.update.import') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-contents">
                                <div class="row my-2">
                                    <x-utility.forms.input label="XLS/XLSX file" type="file" name="excel"
                                        id="name" :required="true" size="col-lg-6" :value="old('excel')"
                                        class="" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <x-utility.forms.button type="submit" label="Import" class="submit-btn" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
