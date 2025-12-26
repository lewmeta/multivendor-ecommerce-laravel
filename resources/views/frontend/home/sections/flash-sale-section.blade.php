<!--Flash Sale-->
<section class="section-paddingm flash_sell_section pb-5">
    <div class="container">
        <div class="section-title wow animate__animated animate__fadeIn">
            <h3 class="">Daily Best Sells</h3>
            <div class="flash_countdown">
                {{-- <div class="deals-countdown"
                    data-countdown="{{ date('Y/m/d', strtotime($flashSale->sale_end)) }} 00:00:00"></div> --}}
            </div>

        </div>
        <div class="row">
            <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                <div class="banner-img style-2">
                    <img src="{{ asset("assets/frontend/dist/imgs/slider/slider-1.png") }}" alt="">
                    <div class="banner-text">
                        <h2 class="mb-50">Some title</h2>
                        <a href="#" class="btn btn-xs">Shop
                            Now <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                <div class="tab-content" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel"
                        aria-labelledby="tab-one-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow"
                                id="carausel-4-columns-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                {{-- @foreach ($flashSaleProducts as $saleProduct)
                                    <x-frontend.product-card :product="$saleProduct" />
                                @endforeach --}}

                            </div>
                        </div>
                    </div>

                </div>
                <!--End tab-content-->
            </div>
            <!--End Col-lg-9-->
        </div>
    </div>
</section>
<!--End Flash Sale-->