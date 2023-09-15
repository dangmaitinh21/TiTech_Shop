@extends('main')

@section('content')
<div class="p-t-120">
    @include('components.alert')
    <form action="/checkout" method="POST">
        @csrf
        <input type="number" name="price" placeholder="enter price test" step="any" />
        <label for="card-element">
            Credit or debit card
        </label>
        <div id="card-element">
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>

        <button type="submit">Submit Payment</button>
    </form>
</div>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe("{{ config('services.stripe.key') }}");

        var elements = stripe.elements();
        var cardElement = elements.create('card');

        cardElement.mount('#card-element');

        var form = document.querySelector('form');
        var cardErrors = document.getElementById('card-errors');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    cardErrors.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    // You can handle payment processing on your server.
                    var token = result.token.id;
                    // Add the token to the form and submit it to your server
                    var hiddenInput = document.createElement('input');
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
