@extends('adminPage.index')

@section('mainContent')
<div class="card">
    <div class="card-body">
        <ul style="list-style: none;">
            <li>Name: {{ $customer->name }}</li>
            <li>Address: {{ $customer->address }}</li>
            <li>Phone: {{ $customer->phone }}</li>
            <li>Email: {{ $customer->email }}</li>
            <li>Note: {{ $customer->note }}</li>
        </ul>
    </div>
</div>

<div>
    <table class="table-shopping-cart">
        <tr class="table_head">
            <th class="column-1">Product</th>
            <th class="column-2"></th>
            <th class="column-3">Price</th>
            <th class="column-4">Quantity</th>
            <th class="column-5">Total</th>
            <th>&nbsp;</th>
        </tr>
        @foreach($products as $key => $product)
        @php
        $price = $product->price_sale != 0 ? $product->price_sale : $product->price;
        $priceTotal = $price * $carts[$product->id];
        $total = $total + $priceTotal;
        @endphp
        <tr class="table_row">
            <td class="column-1">
                <div class="how-itemcart1">
                    <img src="{{ $product->image }}" alt="IMG">
                </div>
            </td>
            <td class="column-2">{{ $product->name }}</td>
            <td class="column-3">{{ \App\Helpers\Helper::price($product->price, $product->price_sale) }}</td>
            <td class="column-4">
                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                        <i class="fs-16 zmdi zmdi-minus"></i>
                    </div>

                    <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product[{{ $product->id }}]" value="{{ $carts[$product->id] }}">

                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                        <i class="fs-16 zmdi zmdi-plus"></i>
                    </div>
                </div>
            </td>
            <td class="column-5">{{ $priceTotal }}$</td>
            <td>
                <a class="btn btn-danger btn-sm m-r-20" href="/carts/delete-product/{{ $product->id }}" ><i class="fa-solid fa-xmark"></i></a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection