@extends('vendor_dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="row row-deck row-cards">
             <div class="col-12">
                <div class="row row-cards">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span
                                            class="bg-warning avatar text-white"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                            <i class="ti ti-shopping-bag-exclamation"></i></span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">10 Orders</div>
                                        <div class="text-secondary">Total Pending Orders</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span
                                            class="bg-success avatar text-white"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                            <i class="ti ti-shopping-bag-heart"></i></span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{ $completedOrders }} Orders</div>
                                        <div class="text-secondary">Total Completed Orders</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span
                                            class="bg-danger avatar text-white"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                            <i class="ti ti-shopping-bag-x"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{ $canceledOrders }} Orders</div>
                                        <div class="text-secondary">Total Cancelled Orders</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span
                                            class="bg-primary avatar text-white"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                            <i class="ti ti-shopping-bag-plus"></i></span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{ $totalOrders }} Orders</div>
                                        <div class="text-secondary">Total Orders</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span
                                            class="bg-success avatar text-white"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                            <i class="ti ti-box"></i></span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{ $totalProducts }} Items</div>
                                        <div class="text-secondary">Total Products</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span
                                            class="bg-warning avatar text-white"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                            <i class="ti ti-box"></i></span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{ $totalPendingProducts }} Items</div>
                                        <div class="text-secondary">Total Pending Products</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span
                                            class="bg-success avatar text-white"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                            <i class="ti ti-box"></i></span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{ $totalApprovedProducts }} Items</div>
                                        <div class="text-secondary">Total Approved Products</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span
                                            class="bg-danger avatar text-white"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                            <i class="ti ti-box"></i></span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{ $totalRejectedProducts }} Items</div>
                                        <div class="text-secondary">Total Rejected Products</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-warning avatar text-white">
                                            <i class="ti ti-user"></i></span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{ $totalPendingKycRequests }} Kyc's</div>
                                        <div class="text-secondary">Total Pending Requests</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-success avatar text-white">
                                            <i class="ti ti-user-check"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{ $totalApprovedKycRequests }} Kyc's</div>
                                        <div class="text-secondary">Total Approved Requests</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-danger avatar text-white">
                                            <i class="ti ti-user-x"></i></span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{ $totalRejectedKycRequests }} Kyc's</div>
                                        <div class="text-secondary">Total Rejected Requests</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-purple avatar text-white">
                                            <i class="ti ti-user"></i></span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{ $totalKycRequests }} Kyc's</div>
                                        <div class="text-secondary">Total Requests</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>


            </div>
        </div>
    </div>
@endsection
