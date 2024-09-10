<x-admin-layout>
    <div class="main shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header px-0">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <h3>Email Templates</h3>
                        </div>
                        <div class="col-lg-2 my-auto text-end ms-auto">
                            <a href="{{ route('email-template.create') }}" class="add-btn bg-success text-white">
                                Add Template
                            </a>
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
                            ['label' => 'Name', 'column' => 'title', 'sort' => true],
                            ['label' => 'Subject', 'column' => 'subject', 'sort' => true],
                            ['label' => 'From Id', 'column' => 'from_id', 'sort' => true],
                            ['label' => 'From Name', 'column' => 'from_name', 'sort' => true],
                            ['label' => 'Actions', 'column' => 'action', 'sort' => false],
                        ];
                    @endphp
                    <x-utility.table :columns="$columns" :data="$templates" :route="route('email.templates')">
                        @foreach ($templates as $key => $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->subject }}</td>
                                <td>{{ $item->from_id }}</td>
                                <td>{{ $item->from_name }}</td>
                                <td>
                                    <a href="{{ route('email-template.edit', $item->id) }}">
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <a onclick="return confirm('Are you sure you want to delete this?')"
                                        href="{{ route('email-template.delete', $item->id) }}">
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
