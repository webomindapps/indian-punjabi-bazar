<x-admin-layout>
    <div class="main shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header px-0">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <h3>Sliders</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="form-card">
                        <div class="row mb-2">
                            <div class="col-lg-2 my-auto text-end ms-auto">
                                <a href="{{ route('slider.create') }}" class="add-btn bg-success text-white">Add
                                    Sliders
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @php
                        $columns = [
                            ['label' => 'Id', 'column' => 'id', 'sort' => true],
                            ['label' => 'Slider', 'column' => 'slider_path', 'sort' => false],
                            ['label' => 'Name', 'column' => 'title', 'sort' => true],
                            ['label' => 'Position', 'column' => 'position', 'sort' => true],
                            ['label' => 'URL', 'column' => 'url', 'sort' => true],
                            ['label' => 'Actions', 'column' => 'action', 'sort' => false],
                        ];
                    @endphp
                    <x-utility.table :columns="$columns" :data="$sliders" :route="route('sliders')">
                        @foreach ($sliders as $key => $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <img src="{{ asset($item->slider_path) }}" alt="" style="height: 80px;">
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->position }}</td>
                                <td>{{ $item->url }}</td>
                                <td>
                                    <a href="{{ route('slider.edit', $item->id) }}">
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <a onclick="return confirm('Are you sure you want to delete this?')"
                                        href="{{ route('slider.delete', $item->id) }}">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </x-utility.table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
