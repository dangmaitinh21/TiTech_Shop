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
            $total = $cart->price * $cart->pty
            @endphp
            <tr class="table_row">
                <td class="column-1">
                    <div class="how-itemcart1">
                        <img src="" alt="IMG">
                    </div>
                </td>
                <td class="column-2">product name</td>
                <td class="column-3">{{ $cart->price }}</td>
                <td class="column-4">{{ $cart->pty }}</td>
                <td class="column-5">{{ $total }}$</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection