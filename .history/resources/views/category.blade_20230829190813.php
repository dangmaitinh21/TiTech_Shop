@extends('main')

@section('content')
<section class="bg0 p-t-300 p-b-140">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                {{ $category->name }}
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