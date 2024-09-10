<!-- An unexamined life is not worth living. - Socrates -->
<!-- It is never too late to be what you might have been. - George Eliot -->
<div>
    <input type="hidden" id="current_route" value="{{ $route }}">
    @if (isset($type))
        <input type="hidden" id="type" value="{{ $type }}">
    @endif
    <div class="row mb-2 align-items-end">
        <div class="col-md-2">
            <label for="">Show</label>
            <select name="per_page" id="per_page">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="500">500</option>
            </select>
        </div>
        <div class="col-md-7">
            @if (isset($filters))
                {{ $filters }}
            @endif
        </div>
        <div class="col-md-3 text-right">
            <form id="searchForm">
                <div class="search-bar">
                    <input type="search" placeholder="Search..." id="searchBox">
                    <i class='bx bx-search'></i>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-2">
            @foreach (request()->query() as $key => $value)
                @if ($value !== null && $key !== 'orderBy')
                    <span class="filtValue" data-key="{{ $key }}" data-value="{{ $value }}">
                        {{ $key }}: {{ $value }}
                        <span style="font-weight: 600;cursor: pointer;" class="remove-link">&times;</span>
                    </span>
                @endif
            @endforeach
        </div>

        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        @if (isset($checkAll) && $checkAll)
                            <th>
                                <input type="checkbox" name="" id="main_check" onclick="check_uncheck()">
                            </th>
                        @endif
                        @foreach ($columns as $column)
                            <th class="sorting" data-sort="{{ $column['sort'] }}" data-column="{{ $column['column'] }}"
                                scope="col">
                                {{ $column['label'] }}
                            </th>
                        @endforeach
                        <th id="action_th" style="display: none;" colspan="{{ count($columns) }}">
                            <div class="row g-2">
                                <div class="col-md-2">
                                    <select id="action" style="padding: 8px 10px;">
                                        <option value="">Select operation</option>
                                        <option value="delete">Delete</option>
                                        @if (isset($type))
                                            <option value="updateCategory">Update Category</option>
                                        @endif
                                        <option value="updateSts">Update Status</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select id="status" name="" style="padding: 8px 10px;display:none;">
                                        <option value="">Select status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                {{-- <button type="submit" class="btn btn-success">Submit</button> --}}
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{ $slot }}
                </tbody>
            </table>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-lg-12">
            {{ $data->links() }}
        </div>
    </div>

</div>
<style>
    .filtValue {
        padding: 5px 10px;
        border-radius: 5px;
        background: rgba(224, 224, 224, 0.959);
        margin-right: 5px;
    }
</style>
@push('scripts')
    <script>
        var table = {
            search: '',
            orderedColumn: "",
            orderBy: 'asc',
            type: null,
            paginate: null,
            category_id: "",
        }
        $(document).ready(function() {
            let search = new URLSearchParams(window.location.search).get("search");
            let orderedColumn = new URLSearchParams(window.location.search).get("orderedColumn");
            let orderBy = new URLSearchParams(window.location.search).get("orderBy");
            let type = new URLSearchParams(window.location.search).get("type");
            let paginate = new URLSearchParams(window.location.search).get("paginate");
            let category_id = new URLSearchParams(window.location.search).get("category_id");


            table.search = search ? search : '';
            $('#searchBox').val(search ? search : '');
            table.category_id = category_id ? category_id : '';
            $('#category_id').val(category_id ? category_id : '');
            table.orderedColumn = orderedColumn ? orderedColumn : '';
            table.orderBy = orderBy ? orderBy : '';
            table.type = type ? type : null;
            table.paginate = paginate ? paginate : null;
            $('#per_page').val(paginate ? paginate : '10');

        });


        $(document).on('click', '.sorting', function() {
            var isSort = $(this).data('sort');
            var column = $(this).data('column');
            if (isSort) {
                let orderBy = new URLSearchParams(window.location.search).get("orderBy");
                if (!orderBy) {
                    table.orderBy = 'asc';
                } else if (orderBy == 'asc') {
                    table.orderBy = 'desc'
                } else {
                    table.orderBy = 'asc';
                }
                table.orderedColumn = column;
                getRecords();
            }
        });

        $('#searchForm').submit(function(e) {
            e.preventDefault();
            table.search = $('#searchBox').val();
            getRecords();
        });
        $('#searchBox').on('change', function(e) {
            e.preventDefault();
            table.search = $(this).val();
            getRecords();
        });
        $('#category_id').on('change', function(e) {
            e.preventDefault();
            table.category_id = $(this).val();
            getRecords();
        });

        $('#per_page').on('change', function() {
            table.paginate = $(this).val();
            getRecords();
        });

        function getRecords() {
            let route_name = $('#current_route').val();
            let url = route_name + `?${$.param( table )}`;
            window.location.href = url;
        }

        function check_uncheck() {
            $(".checkinput").prop("checked", $("#main_check").prop("checked"));
            if ($("#main_check").prop("checked")) {
                $('.sorting').hide();
                $('#action_th').show();
            } else {
                $('.sorting').show();
                $('#action_th').hide();
            }
        }
        $('input[type="checkbox"]').click(function() {
            if (!$(this).is(":checked")) {
                $("#main_check").prop("checked", false)
                $('.sorting').show();
                $('#action_th').hide();
            } else {
                $('.sorting').hide();
                $('#action_th').show();
            }
        });
        $('#action').on('change', function() {
            let option = $(this).val();
            if (option == 'updateSts') {
                console.log(option + " jhjj");
                $('#status').show();
            } else if (option == 'delete') {
                $('#status').hide();
                deleteAll();
            } else if (option == 'updateCategory') {
                $('#status').hide();
                updateMassCategory();
            }
        });
        $('#status').on('change', function() {
            let status = $(this).val();
            ids = [];
            $('.checkinput:checkbox:checked').each(function() {
                ids.push($(this).val());
            });
            let route_name = $('#current_route').val();
            console.log(ids);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                type: "POST",
                url: route_name + "/statusChng_selected",
                datatype: "text",
                data: {
                    ids: ids,
                    status: status
                },
                success: function(response) {
                    window.location.reload();
                },
                error: function(xhr, ajaxOptions, thrownError) {}
            });
        });

        function deleteAll() {
            ids = [];
            $('.checkinput:checkbox:checked').each(function() {
                ids.push($(this).val());
            });
            let route_name = $('#current_route').val();
            console.log(ids);
            var confirmDelete = confirm("Are you sure you want to delete the selected items?");
            if (confirmDelete) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    type: "POST",
                    url: route_name + "/delete_selected",
                    datatype: "text",
                    data: {
                        ids: ids
                    },
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {}
                });
            }
        }

        function updateMassCategory() {
            ids = [];
            $('.checkinput:checkbox:checked').each(function() {
                ids.push($(this).val());
            });
            let route_name = $('#current_route').val();
            window.location.href = route_name + "/mass_category_update?ids=" + ids.join(',');
        }
        $(document).ready(function() {
            $('.remove-link').click(function(e) {
                e.preventDefault();

                var span = $(this).closest('.filtValue');
                var keyToRemove = span.data('key');
                var valueToRemove = span.data('value');
                var currentUrl = window.location.href;
                var url = new URL(currentUrl);
                url.searchParams.delete(keyToRemove);

                // Construct the new URL
                var newUrl = url.toString();

                // Redirect to the updated URL
                window.location.href = newUrl;
            });
        });
    </script>
@endpush
