<x-admin-layout>
    <div class="main shadow-sm">
        <div class="container-fluid">
            <div class="row" id="products">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <a onclick="history.length > 1 ? history.go(-1) : window.location = window.location.origin;">
                                <i class="fas fa-chevron-left fs-5"></i>
                            </a>
                            <x-utility.additional.title title="Update Product" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 mx-auto">
                    <div class="form-section">
                        <form method="POST" action="{{ route('product.edit', $product->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-contents">
                                <div class="row my-2">
                                    <x-utility.additional.form-title title="Select categories" size="col-lg-12" />
                                    @php
                                        $existing_ids = $product->categories()->pluck('category_id')->toArray();
                                    @endphp
                                    <x-utility.category.products.tree size="col-lg-12" :category="$existing_ids"
                                        :all="Punjabi::getAllCategories()" />

                                    <div class="col-lg-12">
                                        @if ($errors->has('category_id.*'))
                                            <small
                                                class="form-text text-danger">{{ $errors->first('category_id.*') }}</small>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="form-contents">
                                <div class="row mb-2">
                                    <x-utility.additional.form-title title="General details" size="col-lg-12" />
                                    <x-utility.forms.input label="Name" type="text" name="name" id="name"
                                        :required="true" size="col-lg-6" :value="$product->name" class="slug" />

                                    <x-utility.forms.input label="SKU" type="text" name="sku" id="sku"
                                        :required="true" size="col-lg-6" :value="$product->sku" />

                                    {{-- <x-utility.forms.input label="Url key" type="text" name="url_key" id="slug"
                                        :required="true" size="col-lg-12" :value="$product->url_key" /> --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <select class="form-control" name="brand">
                                                <option value="">Select</option>
                                                @foreach ($brands as $option)
                                                    <option value="{{ $option->id }}"
                                                        {{ $product->brand == $option->id ? 'selected' : '' }}>
                                                        {{ $option->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('brand')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Tax</label>
                                            <select class="form-control" name="tax_id">
                                                <option value="">Select</option>
                                                @foreach ($taxes as $option)
                                                    <option value="{{ $option->id }}"
                                                        {{ $product->tax_id == $option->id ? 'selected' : '' }}>
                                                        {{ $option->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('tax_id')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Product Weight Type</label>
                                            <select class="form-control" name="weight_type">
                                                <option value="">Select</option>
                                                @foreach ($units as $unit)
                                                    <option
                                                        {{ $product->weight_type == $unit->name ? 'selected' : '' }}>
                                                        {{ $unit->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('weight_type')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <x-utility.forms.input label="Product weight" type="number" name="weight"
                                        :required="false" size="col-lg-6" :value="$product->weight" />
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Flavour</label>
                                            <select class="form-control" name="flavour">
                                                <option value="">Select</option>
                                                @foreach ($flavours as $flavour)
                                                    <option {{ $product->flavour == $flavour->id ? 'selected' : '' }}
                                                        value="{{ $flavour->id }}">
                                                        {{ $flavour->flavour }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('flavour')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Source</label>
                                            <select class="form-control" name="source">
                                                <option value="">Select</option>
                                                @foreach ($sources as $source)
                                                    <option {{ $product->source == $source->id ? 'selected' : '' }}
                                                        value="{{ $source->id }}">
                                                        {{ $source->source }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('source')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Form</label>
                                            <select class="form-control" name="form">
                                                <option value="">Select</option>
                                                @foreach ($forms as $form)
                                                    <option {{ $product->form == $form->id ? 'selected' : '' }}
                                                        value="{{ $form->id }}">
                                                        {{ $form->form }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('form')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <x-utility.forms.switch label="New" name="is_new" id="is_new"
                                        size="col-lg-12" :checked="$product->is_new" :value="1" />

                                    <x-utility.forms.switch label="Best seller" name="is_best_seller"
                                        id="is_best_seller" size="col-lg-12" :value="1" :checked="$product->is_best_seller" />

                                    <x-utility.forms.switch label="Featured" name="is_featured" id="is_featured"
                                        size="col-lg-12" :value="1" :checked="$product->is_featured" />
                                    <x-utility.forms.switch label="In Stock" name="in_stock" id="in_stock"
                                        size="col-lg-12" :value="1" :checked="$product->in_stock" />

                                </div>
                            </div>


                            <div class="form-contents">
                                <div class="row mb-2">
                                    <x-utility.additional.form-title title="Product details" size="col-lg-12" />

                                    <x-utility.forms.input label="Small description" type="text"
                                        name="small_description" id="small_description" :required="true"
                                        size="col-lg-12" :value="$product->small_description" />

                                    <x-utility.forms.textarea label="Description" name="description" id="description"
                                        :required="false" size="col-lg-12 mt-3" :value="$product->description"
                                        :editor="true" />

                                    <x-utility.forms.textarea label="Suggested use" name="how_to_use" id="how_to_use"
                                        :required="false" size="col-lg-12 mt-3" :value="$product->how_to_use"
                                        :editor="true" />

                                    <x-utility.forms.textarea label="Ingredients" name="ingredients" id="ingredients"
                                        :required="false" size="col-lg-12 mt-3" :value="$product->ingredients"
                                        :editor="true" />
                                    <x-utility.forms.textarea label="Disclaimer" name="disclaimer" id="disclaimer"
                                        :required="false" size="col-lg-12" :value="$product->disclaimer" :editor="true" />

                                </div>
                            </div>

                            <div class="form-contents">
                                <div class="row mb-2">
                                    <x-utility.additional.form-title title="Price details" size="col-lg-12" />

                                    <x-utility.forms.input label="Price" type="text" name="price"
                                        id="price" :required="true" size="col-lg-4" :value="$product->price"
                                        class="number" />

                                    <x-utility.forms.input label="Cost" type="number" name="cost"
                                        id="cost" :required="false" size="col-lg-4" :value="$product->cost"
                                        class="number" />

                                    <x-utility.forms.input label="Special price" type="number" name="special_price"
                                        id="special_price" :required="false" size="col-lg-4" :value="$product->special_price"
                                        class="number" />

                                    <x-utility.forms.input label="Special price from" type="date"
                                        name="special_price_from" id="special_price_from" :required="false"
                                        size="col-lg-6" :value="$product->special_price_from" />

                                    <x-utility.forms.input label="Special price to" type="date"
                                        name="special_price_to" id="special_price_to" :required="false"
                                        size="col-lg-6" :value="$product->special_price_to" />

                                </div>
                            </div>

                            {{-- <div class="form-contents">
                                <div class="row mb-2">
                                    <x-utility.additional.form-title title="Product variant" size="col-lg-12" />
                                    <div class="col-lg-12">
                                        <table class="w-100 bordered" style="border:1px grey;">
                                            <thead>
                                                <tr>
                                                    <th>Varient Image</th>
                                                    <th>Varient Type</th>
                                                    <th>Varient</th>
                                                    <th>Value</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($product->variants as $variant)
                                                    <tr>
                                                        <td>
                                                            <img src="{{ asset($variant->variant_image) }}"
                                                                alt="" style="height: 80px;">
                                                        </td>
                                                        <td>{{ $variant->variant->name }}</td>
                                                        <td>{{ $variant->variant_value->name }}</td>
                                                        <td>{{ $variant->variant_value->value }}</td>
                                                        <td>
                                                            <a onclick="return confirm('Are you sure you want to delete this?')"
                                                                href="{{ route('variante.delete', $variant->id) }}">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-12">
                                        <product-variant :all_variants="{{ Punjabi::variants() }}" />
                                    </div>
                                </div>
                            </div> --}}

                            <div class="form-contents">
                                <div class="row mb-2">
                                    <x-utility.additional.form-title title="Inventory" size="col-lg-12" />

                                    <x-utility.forms.input label="Default" type="text" name="default"
                                        id="default" :required="true" size="col-lg-12" :value="$product->getInventory()"
                                        class="number" />

                                </div>
                            </div>

                            <x-utility.additional.seo-form :title="$product->getMetaTags()['title']" :description="$product->getMetaTags()['description']" :keywords="$product->getMetaTags()['keywords']" />



                            <div class="form-contents">
                                <div class="row mb-2">

                                    <x-utility.forms.select label="Status" :options="Punjabi::getStatus()" name="status"
                                        id="status" :required="true" size="col-lg-6" :value="$product->status" />

                                    <x-utility.forms.input label="Image" type="file" name="thumbnail"
                                        id="thumbnail" :required="false" size="col-lg-6" :image="true"
                                        :imageValue="asset('storage/' . $product->thumbnail)" class="image-file" />

                                    <x-utility.additional.form-title title="Product images" size="col-lg-12" />

                                    <x-utility.forms.input label="Product images" type="file"
                                        name="product_images[]" id="product_images" :required="false"
                                        size="col-lg-12" :value="old('icon')" :image="true" class="multiple-images"
                                        :multiple="true" />
                                    <div class="col-12">
                                        <div class="images p-2">
                                            <div class="row">
                                                @foreach ($product->images as $image)
                                                    <div class="col-md-2 px-1">
                                                        <div class="border position-relative">
                                                            <img src="{{ asset($image->image_url) }}" alt=""
                                                                srcset="" class="w-100">
                                                            <a onclick="return confirm('Are you sure you want to delete this?')"
                                                                href="{{ route('product.image.delete', $image->id) }}"
                                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1">
                                                                <i class='bx bxs-trash text-white'></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <x-utility.forms.button type="submit" label="Update" class="submit-btn" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
