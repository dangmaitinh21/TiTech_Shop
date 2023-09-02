@extends('adminPage.index')

@section('mainContent')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Customer Information</h5>
        <div>
            <ul style="list-style: none;">
                <li><strong>Name:</strong> {{ $customer->name }}</li>
                <li><strong>Address</strong>: {{ $customer->address }}</li>
                <li><strong>Phone:</strong> {{ $customer->phone }}</li>
                <li><strong>Email:</strong> {{ $customer->email }}</li>
                <li><strong>Note:</strong> {{ $customer->note }}</li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @php $total = 0; @endphp
        <table class="table table-hover text-nowrap">
            <tr class="table_head">
                <th class="column-1">Product</th>
                <th class="column-2">Product Name</th>
                <th class="column-3">Price</th>
                <th class="column-4">Quantity</th>
                <th class="column-5">Total</th>
            </tr>
            @foreach($carts as $key => $cart)
            @php
            $price = $cart->price * $cart->pty;
            $total+=$price;
            @endphp
            <tr class="table_row">
                <td class="column-1">
                    <div class="how-itemcart1">
                        <img src="{{ $cart->product->image }}" alt="IMG" width="30px">
                    </div>
                </td>
                <td class="column-2">{{ $cart->product->name }}</td>
                <td class="column-3">{{ $cart->price }}$</td>
                <td class="column-4">x {{ $cart->pty }}</td>
                <td class="column-5">{{ $price }}$</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4">&nbsp;</td>
                <th>Total: {{ $total }}$</th>
            </tr>
        </table>
    </div>
</div>
@endsection