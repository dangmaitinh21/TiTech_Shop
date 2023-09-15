@extends('main')

@section('content')
<div class="p-t-120">
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="/carts" class="stext-109 cl8 hov-cl1 trans-04">
                Shoping Cart
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Checkout
            </span>
        </div>
    </div>    

    <form class="bg0 p-t-75 p-b-85" action="/carts/checkout" method="POST">
    @csrf
        <div class="container">
            <div class="row d-flex flex-c flex-col-c">
                <div class="col-5 m-lr-auto m-b-50">
                    <div class="customer-information p-b-33">
                        <h3>Information</h3>
                        <hr>    
                        <div class="container">
                            <div class="row">
                                <div class="col-3">Total Price:</div>
                                <div class="col-9">1000</div>
                            </div>
                        </div>
                            
                    </div>
                
                    <div class="credit-card">
                        <div id="card-element"></div>
                    </div>

                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>

                    <div class="m-t-33">
                        <button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">Pay</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ config('services.stripe.key') }}");
        const elements = stripe.elements();

        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const form = document.querySelector('form');
        const cardErrors = document.getElementById('card-errors');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    cardErrors.textContent = result.error.message;
                } else {
                    const token = result.token.id;
                    const hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', token);
                    form.appendChild(hiddenInput);

                    // Submit the form
                    form.submit();
                }
            });
        });
    </script>
    
@endsection
