@extends('front.layout.master')
@section('title')
    Shop
@endsection
@section('content')
    <!-- Breadcrumb section begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="index.html"><i class="fa fa-home"></i>Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb section end -->

    <!-- product shop section begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                    @include('front.shop.components.product-filter')
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="product-show-option">
                        <div class="row">
                            <div class="col-lg-7 col-md-7">
                                <form action="">
                                    <div class="select-option">
                                        <select onchange="this.form.submit();" name="sort_by" class="sorting" name=""
                                            id="">
                                            <option {{ request('sort_by') == 'latest' ? 'selected' : '' }} value="latest">
                                                Sorting latest</option>
                                            <option {{ request('sort_by') == 'oldest' ? 'selected' : '' }} value="oldest">
                                                oldest Sorting</option>
                                            <option {{ request('sort_by') == 'name-ascending' ? 'selected' : '' }}
                                                value="name-ascending">Sorting Name A-Z</option>
                                            <option {{ request('sort_by') == 'name-descending' ? 'selected' : '' }}
                                                value="name-descending">Sorting Name Z-A</option>
                                            <option {{ request('sort_by') == 'price-ascending' ? 'selected' : '' }}
                                                value="price-ascending">Sorting Price ascending</option>
                                            <option {{ request('sort_by') == 'price-descending' ? 'selected' : '' }}
                                                value="price-descending">Sorting Price descending</option>
                                        </select>
                                        <select onchange="this.form.submit();" name="show" class="p-show" name=""
                                            id="">
                                            <option {{ request('show') == '6' ? 'selected' : '' }} value="6">
                                                Show: 6</option>
                                            <option {{ request('show') == '9' ? 'selected' : '' }} value="9">
                                                Show: 9</option>
                                            <option {{ request('show') == '15' ? 'selected' : '' }} value="15">
                                                Show: 15</option>
                                        </select>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="product-list">
                        <div class="row">
                            @foreach ($product as $item)
                                <div class="col-lg-4 col-sm-6">
                                    @include('front.components.product-item')
                                </div>
                            @endforeach

                        </div>
                    </div>
                    {{ $product->links() }}
                    {{-- <div class="loading-more">
                        <i class="icon_loading"></i>
                        <a href="">loading More</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- product shop section end -->
@endsection
