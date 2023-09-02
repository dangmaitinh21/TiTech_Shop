@extends('main')

@section('content')
<!-- Banner -->
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">
            @foreach($categories as $category)
            <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w">
                    <img src="/template/images/banner-01.jpg" alt="IMG-BANNER">

                    <a href="/categories/{{ $category->id }}-{{ \Str::slug($category->name, '-') }}.html" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                {{ $category->name }}
                            </span>

                            <span class="block1-info stext-102 trans-04">
                                Autumn 2023
                            </span>
                        </div>

                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Shop Now
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                Product Overview
            </h3>
        </div>

        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                    All Products
                </button>
            </div>
        </div>
            
        <div id="list-products">
            @include('products.list')
        </div>

        <!-- Load more -->
        <div class="flex-c-m flex-w w-full p-t-45" id="btn-loadMoreProducts">
            <input type="hidden" value="1" id="page">
            <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04" onclick="loadMoreProducts(event)">
                Load More
            </a>
        </div>
    </div>
</section>
@endsection