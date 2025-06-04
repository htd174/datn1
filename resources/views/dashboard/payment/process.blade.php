@extends('layouts.dashboard')

@section('content')
<div class="db-cent-3">
    <div class="db-cent-table db-com-table">
        <div class="db-title">
            <h3><img src="{{ asset("front/images/icon/dbc5.png") }}" alt=""/> Payment Processing</h3>
            <p>Complete your payment for the booking.</p>
        </div>
        
        <div class="db-title">
            @foreach ($errors->all() as $error)
                <p style="color:red">{{ $error }}</p>
            @endforeach
            @if(session('flash_message'))
                <p style="color:green">{{ session('flash_title') }}, {{ session('flash_message') }}</p>
            @endif
            @if(empty($debugClientSecret))
                <p style="color:rgb(0, 254, 76)">Payment successed!.</p>
            @else
                <div style="color:gray; font-size:12px;">Debug clientSecret: {{ $debugClientSecret }}</div>
            @endif
        </div>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Payment Details</h4>
                        <p class="card-text">Amount to pay: ${{ number_format($amount, 2) }}</p>
                        
                        <form id="payment-form" action="{{ route('payment.confirm') }}" method="POST">
                            @csrf
                            <input type="hidden" name="payment_intent" id="payment-intent">
                            <input type="hidden" name="booking_type" value="{{ $type }}">
                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                            
                            <div class="form-group">
                                <label for="card-element">Credit or debit card</label>
                                <div id="card-element" class="form-control"></div>
                                <div id="card-errors" class="invalid-feedback" role="alert"></div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary" id="submit-button">
                                Pay ${{ number_format($amount, 2) }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Initialize Stripe
    const stripe = Stripe('{{ config('services.stripe.key') }}');
    const elements = stripe.elements();
    
    // Create card Element
    const card = elements.create('card');
    card.mount('#card-element');
    
    // Handle real-time validation errors
    card.addEventListener('change', function(event) {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    
    // Handle form submission
    const form = document.getElementById('payment-form');
    const submitButton = document.getElementById('submit-button');
    
    form.addEventListener('submit', async function(event) {
        event.preventDefault();
        submitButton.disabled = true;
        
        try {
            const {paymentIntent, error} = await stripe.confirmCardPayment('{{ $clientSecret }}', {
                payment_method: {
                    card: card,
                    billing_details: {
                        name: '{{ Auth::user()->name }}'
                    }
                }
            });
            
            if (error) {
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
                submitButton.disabled = false;
            } else {
                document.getElementById('payment-intent').value = paymentIntent.id;
                form.submit();
            }
        } catch (e) {
            console.error('Error:', e);
            submitButton.disabled = false;
        }
    });
</script>
@endsection 