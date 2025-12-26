<section class="home-slider position-relative mb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 d-none d-xxl-flex">
                <div class="categories-dropdown-wrap style-2 font-heading mt-30">
                    <div class="d-flex categori-dropdown-inner">
                        <ul>
                            Categories
                            {{-- @foreach (getNestedCategories() as $category)
                                @if ($loop->iteration <= 11)
                                    <li>
                                        <a href="{{ route('products.index', ['category' => $category->slug]) }}">
                                            <img src="{{ asset($category->icon) }}" alt="" />
                                            <span>{{ $category->name }}</span>
                                        </a>
                                        @if (count($category->children_nested) > 0)
                                            <ul>
                                                @foreach ($category->children_nested as $child)
                                                    <li
                                                        class="{{ count($child->children_nested) > 0 ? '' : 'no_child' }}">
                                                        <a
                                                            href="{{ route('products.index', ['category' => $child->slug]) }}">{{ $child->name }}</a>
                                                        @if (count($child->children_nested) > 0)
                                                            <ul>
                                                                @foreach ($child->children_nested as $subchild)
                                                                    <li class="no_child">
                                                                        <a
                                                                            href="{{ route('products.index', ['category' => $subchild->slug]) }}">{{ $subchild->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endif
                            @endforeach --}}
                        </ul>
                    </div>
                    <a href="#" class="more_categories">
                        view all
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-8 col-xl-9 col-xxl-7">
                <div class="home-slide-cover mt-30">
                    <div class="hero-slider-1 style-5 dot-style-1 dot-style-1-position-2">
                        {{-- @foreach ($sliders as $slider) --}}
                            <div class="single-hero-slider single-animation-wrap"
                                style="background-image: url({{ asset("assets/frontend/dist/imgs/slider/slider-1.png") }})">
                                <div class="slider-content">
                                    <h1 class="display-2 mb-15">Shot it</h1>
                                    <p>Power in your hands</p>
                                    <a href="#" class="btn">Shop Now <i
                                            class="fi-rs-arrow-small-right"></i></a>
                                </div>
                            </div>
                        {{-- @endforeach --}}
                    </div>
                    <div class="slider-arrow hero-slider-1-arrow"></div>
                </div>
            </div>

            <!-- Banners -->
            <div class="col-lg-4 col-xl-3 col-xxl-3">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="banner-img style-4 mt-30">
                            <img src="{{ asset("assets/frontend/dist/imgs/banner/popup-1.png") }}" alt="" />
                            <div class="banner-text">
                                <h4 class="mb-30">Banner 1</h4>
                                <a href="#" class="btn btn-xs mb-50">Shop Now <i
                                        class="fi-rs-arrow-small-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="banner-img style-5 mt-md-30 mt-5">
                            <img src="{{ asset("assets/frontend/dist/imgs/banner/banner-2.png") }}" alt="" />
                            <div class="banner-text">
                                <h5 class="mb-20">Banner 2</h5>
                                <a href="#" class="btn btn-xs">Shop Now <i
                                        class="fi-rs-arrow-small-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
