@extends('main')

@section('content')
@php 
sleep(5);
header("Location: /");
@endphp
<div class="p-t-120">
    <img src="/template/images/confirmation.jpg" alt="order-success">
</div>
@endsection