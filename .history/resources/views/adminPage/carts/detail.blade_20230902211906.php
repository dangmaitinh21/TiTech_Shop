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
                        <img src="" alt="IMG">
                    </div>
                </td>
                <td class="column-2">product name</td>
                <td class="column-3">{{ $cart->price }}$</td>
                <td class="column-4">x {{ $cart->pty }}</td>
                <td class="column-5">{{ $price }}$</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4">&nbsp;</td>
                <td>Total: {{ $total }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection