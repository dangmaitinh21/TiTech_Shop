@extends('adminPage.index')

@section('mainContent')
<div class="card">
    <div class="card-body">
        <table class="table table-borderless text-nowrap">
            <tr>
                <th colspan="2"><h3 style="margin-left: 100px;">Customer Information</h3></th>
            </tr>
            <tr>
                <th style="width: 100px;">
                    <ul style="list-style: none;">
                        <li>Name</li>
                        <li>Address</li>
                        <li>Phone</li>
                        <li>Email</li>
                        <li>Note</li>
                    </ul>
                </th>
                <td>
                    <ul style="list-style: none;">
                        <li>{{ $customer->name }}</li>
                        <li>{{ $customer->address }}</li>
                        <li>{{ $customer->phone }}</li>
                        <li>{{ $customer->email }}</li>
                        <li>{{ $customer->note }}</li>
                    </ul>
                </td>
            </tr>
        </table>
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