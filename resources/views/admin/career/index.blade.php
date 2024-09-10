<x-admin-layout>
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="page-header px-0">
                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-center ">
                            <h3>Candidated list</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="form-card px-3">
                        <div class="row mb-2">
                            <div class="col-md-5">
                                <div class="row justify-content-start">
                                    <div class="col-lg-5">
                                        <div class="cdate">
                                            <input type="date" class="form-control" name="from_date" id="from_date">
                                        </div>
                                    </div>
                                    <div class="col-lg-1 text-center my-auto">
                                        <span class="fw-semibold fs-6">To</span>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="cdate">
                                            <input type="date" class="form-control" name="to_date" id="to_date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="form-card px-3">
                        @php
                            $columns = [
                                ['label' => 'Id', 'column' => 'id', 'sort' => true],
                                ['label' => 'First Name', 'column' => 'first_name', 'sort' => true],
                                ['label' => 'Last Name', 'column' => 'last_name', 'sort' => true],
                                ['label' => 'Email', 'column' => 'email', 'sort' => true],
                                ['label' => 'Phone', 'column' => 'phone', 'sort' => true],
                                ['label' => 'Position', 'column' => 'position', 'sort' => true],
                                ['label' => 'Status', 'column' => 'status', 'sort' => true],
                                ['label' => 'Actions', 'column' => 'action', 'sort' => false],
                            ];
                        @endphp

                        <x-utility.table :columns="$columns" :data="$applicants" :checkAll=false :route="route('applicants')">
                            @foreach ($applicants as $key => $item)
                                <tr>
                                    {{-- <td>
                                    <input type="checkbox" name="" class="checkinput" value="{{ $item->id }}">
                                </td> --}}
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->first_name }}</td>
                                    <td>{{ $item->last_name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->position }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <a href="{{ route('applicant.details', $item->id) }}">
                                            <i class="fas fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </x-utility.table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            var table = {
                from_date: '',
                to_date: '',
            }
            $(document).ready(function() {
                let from_date = new URLSearchParams(window.location.search).get("from_date");
                let to_date = new URLSearchParams(window.location.search).get("to_date");
                table.from_date = from_date ? from_date : '';
                $('#from_date').val(from_date ? from_date : '');
                table.to_date = to_date ? to_date : '';
                $('#to_date').val(to_date ? to_date : '');

            });
            $('#from_date').on('change', function(e) {
                e.preventDefault();
                table.from_date = $(this).val();
                getRecords();
            });
            $('#to_date').on('change', function(e) {
                e.preventDefault();
                table.to_date = $(this).val();
                getRecords();
            });
        </script>
    @endpush
</x-admin-layout>
