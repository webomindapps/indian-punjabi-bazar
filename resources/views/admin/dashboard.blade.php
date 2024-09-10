<x-admin-layout>
    <div class="main">
        <div class="container-fluid">
            <div class="row pt-3 pb-2 border-bottom">
                <div class="col-lg-4">
                    <h3>Dashboard</h3>
                </div>
                <div class="col-lg-8 text-end ms-auto ">
                    <form class="row justify-content-end" id="filterFrom">
                        {{-- <div class="col-lg-3">
                            <select class="form-select" name="store_id" id="ehfcategory-id">
                                <option value="">Select Store</option>
                                <option value="	Kitchener"> Kitchener</option>
                                <option value="Mississauga">Mississauga</option>
                            </select>
                        </div> --}}
                        <div class="col-lg-3">
                            <div class="cdate">
                                <input type="date" class="form-control filter" name="from_date"
                                    value="{{ request()->from_date }}">
                            </div>
                        </div>
                        <div class="col-lg-1 text-center my-auto">
                            <span class="fw-semibold fs-6">To</span>
                        </div>
                        <div class="col-lg-3">
                            <div class="cdate">
                                <input type="date" class="form-control filter" name="to_date"
                                    value="{{ request()->to_date ?? date('Y-m-d') }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row pb-4 px-1">
                <div class="dashboard-stats">
                    <div class="row">
                        <h4 class="title_heading">Modules</h4>
                        <div class="col-lg-3">
                            <a href="{{ route('orders') }}?from_date={{ request()->from_date }}&to_date={{ request()->to_date ?? date('Y-m-d') }}">
                                <div class="dashboard-card">
                                    <div class="title">
                                        Orders
                                    </div>
                                    <div class="data">
                                        {{ $orders }}
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-box-full"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ route('orders') }}?from_date={{ request()->from_date }}&to_date={{ request()->to_date ?? date('Y-m-d') }}">
                                <div class="dashboard-card">
                                    <div class="title">
                                        Processed Sales
                                    </div>
                                    <div class="data">
                                        {{ '$ ' . number_format($completed?? 0, 2) }}
                                        <p>Tax -{{ ' $ ' . number_format($completed_tax?? 0, 2) }}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-box-full"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ route('orders') }}?from_date={{ request()->from_date }}&to_date={{ request()->to_date ?? date('Y-m-d') }}">
                                <div class="dashboard-card">
                                    <div class="title">
                                        Pending Sales
                                    </div>
                                    <div class="data">
                                        {{ '$ ' . number_format($pending?? 0, 2) }}
                                        <p>Tax -{{ ' $ ' . number_format($pending_tax?? 0, 2) }}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-box-full"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ route('order.invoices') }}?from_date={{ request()->from_date }}&to_date={{ request()->to_date ?? date('Y-m-d') }}">
                                <div class="dashboard-card">
                                    <div class="title">
                                        Total Invoice
                                    </div>
                                    <div class="data">
                                        {{ $invoices }}
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-box-full"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ route('order.shipments') }}?from_date={{ request()->from_date }}&to_date={{ request()->to_date ?? date('Y-m-d') }}">
                                <div class="dashboard-card">
                                    <div class="title">
                                        Total Shipment
                                    </div>
                                    <div class="data">
                                        {{ $shipped }}
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-box-full"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ route('order.refunds') }}?from_date={{ request()->from_date }}&to_date={{ request()->to_date ?? date('Y-m-d') }}">
                                <div class="dashboard-card">
                                    <div class="title">
                                        Total Refund
                                    </div>
                                    <div class="data">
                                        {{ $refunds }}
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-box-full"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a
                                href="{{ route('categories') }}?from_date={{ request()->from_date }}&to_date={{ request()->to_date ?? date('Y-m-d') }}">
                                <div class="dashboard-card">
                                    <div class="title">
                                        Categories
                                    </div>
                                    <div class="data">
                                        {{ $categories }}
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-box-full"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ route('products') }}?from_date={{ request()->from_date }}&to_date={{ request()->to_date ?? date('Y-m-d') }}">
                                <div class="dashboard-card">
                                    <div class="title">
                                        Total Products
                                    </div>
                                    <div class="data">
                                        {{ $products }}
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-box-full"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ route('products') }}?from_date={{ request()->from_date }}&to_date={{ request()->to_date ?? date('Y-m-d') }}">
                                <div class="dashboard-card">
                                    <div class="title">
                                        New Products
                                    </div>
                                    <div class="data">
                                        {{ $newproducts }}
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-box-full"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ route('products') }}?from_date={{ request()->from_date }}&to_date={{ request()->to_date ?? date('Y-m-d') }}">
                                <div class="dashboard-card">
                                    <div class="title">
                                        Featured Products
                                    </div>
                                    <div class="data">
                                        {{ $featuredproducts }}
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-box-full"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ route('customers') }}">
                                <div class="dashboard-card">
                                    <div class="title">
                                        Customers
                                    </div>
                                    <div class="data">
                                        {{ $customers }}
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-box-full"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ route('reviews') }}?from_date={{ request()->from_date }}&to_date={{ request()->to_date ?? date('Y-m-d') }}">
                                <div class="dashboard-card">
                                    <div class="title">
                                        Total Reviews
                                    </div>
                                    <div class="data">
                                        {{ $reviews }}
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-box-full"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ route('newsletters') }}?from_date={{ request()->from_date }}&to_date={{ request()->to_date ?? date('Y-m-d') }}">
                                <div class="dashboard-card">
                                    <div class="title">
                                        Total Subscription
                                    </div>
                                    <div class="data">
                                        {{ $subscribers }}
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-box-full"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ route('applicants') }}?from_date={{ request()->from_date }}&to_date={{ request()->to_date ?? date('Y-m-d') }}">
                                <div class="dashboard-card">
                                    <div class="title">
                                        Total Job Application
                                    </div>
                                    <div class="data">
                                        {{ $applications }}
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-box-full"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <h4 class="title_heading">CMS</h4>
                        <div class="col-lg-4">
                            <a href="{{ route('pages') }}">
                                <div class="dashboard-card">
                                    <div class="title">
                                        Pages
                                    </div>
                                    <div class="data">
                                        {{ $pages }}
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-box-full"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a href="{{ route('sliders') }}">
                                <div class="dashboard-card">
                                    <div class="title">
                                        Sliders
                                    </div>
                                    <div class="data">
                                        {{ $sliders }}
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-box-full"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a href="{{ route('banners') }}">
                                <div class="dashboard-card">
                                    <div class="title">
                                        Banners
                                    </div>
                                    <div class="data">
                                        {{ $banners }}
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-box-full"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @push('scripts')
        <script>
            $('.filter').change(function() {
                $('#filterFrom').submit();
            })
        </script>
    @endpush
</x-admin-layout>
