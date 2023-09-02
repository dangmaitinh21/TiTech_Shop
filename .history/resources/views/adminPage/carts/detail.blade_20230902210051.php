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
@endsection