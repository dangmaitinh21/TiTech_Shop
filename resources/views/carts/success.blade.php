@extends('main')

@section('content')
<div class="p-tb-120 d-flex justify-content-center">
    <div class="card" style="width: 18rem;">
        <img src="/template/images/confirmation.jpg" class="card-img-top" alt="order-success">
        <div class="card-body">
            <h5 class="card-title text-center">Hooray! Your order was confirmed</h5>
            <p class="card-text p-b-3">We have sent your order confirmation and invoice to Shop</p>
            <center>
                <button href="/" class="btn btn-primary p-tb-10 p-lr-20 m-t-20">Continue shopping</button>
            </center>
        </div>
    </div>
</div>
@endsection