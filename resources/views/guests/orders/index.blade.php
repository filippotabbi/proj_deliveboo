@extends('layouts.app')

@section('main')
<main>
  <section class="section-main">
      <div class="container">
          <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6" id="app">
                  <cart-checkout></cart-checkout>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                  <div class="checkout-card">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="page-top">
                                  <h2>Le tue info</h2>
                              </div>
                              <div class="checkout-card-inner">
                                  <!-- FORM BRAINTREE -->
                                  @if (session()->has('success_message'))
                                  <div class="alert alert-success">
                                      {{ session()->get('success_message') }}
                                  </div>
                                  @endif

                                  @if(count($errors) > 0)
                                  <div class="alert alert-danger">
                                      <ul>
                                          @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                          @endforeach
                                      </ul>
                                  </div>
                                  @endif
                                  <form method="post" id="payment-form" action="{{route('orders.store')}}">
                                      @csrf
                                      @method('POST')
                                      <section>

                                          <div class="form-group column">
                                              <label for="customer_name" class="col-md-4 col-form-label label-personal">{{ __('Nome') }}</label>

                                              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                  <input id="customer_name" type="text" class="form-control input-personal @error('customer_name') is-invalid @enderror" name="customer_name" value="" required autocomplete="customer_name" autofocus>

                                                  @error('customer_name')
                                                  <small class="text-danger">{{ $message }}</small>
                                                  @enderror
                                              </div>
                                          </div>

                                          <div class="form-group column">
                                              <label for="customer_lastname" class="col-md-4 col-form-label label-personal">{{ __('Cognome') }}</label>

                                              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                  <input id="customer_lastname" type="text" class="form-control input-personal @error('customer_lastname') is-invalid @enderror" name="customer_lastname" value="" required autocomplete="customer_lastname" autofocus>

                                                  @error('customer_lastname')
                                                  <small class="text-danger">{{ $message }}</small>
                                                  @enderror
                                              </div>
                                          </div>

                                          <div class="form-group column">
                                              <label for="customer_email" class="col-md-4 col-form-label label-personal">{{ __('Email') }}</label>

                                              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                  <input id="customer_email" type="email" class="form-control input-personal @error('customer_email') is-invalid @enderror" name="customer_email" value="" required autocomplete="customer_email" autofocus>

                                                  @error('customer_email')
                                                  <small class="text-danger">{{ $message }}</small>
                                                  @enderror
                                              </div>
                                          </div>

                                          <div class="form-group column">
                                              <label for="customer_address" class="col-md-4 col-form-label label-personal">{{ __('Indirizzo') }}</label>

                                              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                  <input id="customer_address" type="text" class="form-control input-personal @error('customer_address') is-invalid @enderror" name="customer_address" value="" required autocomplete="customer_address" autofocus>

                                                  @error('customer_address')
                                                  <small class="text-danger">{{ $message }}</small>
                                                  @enderror
                                              </div>
                                          </div>

                                          <div class="form-group column">
                                              <label for="customer_phone_number" class="col-md-4 col-form-label label-personal">{{ __('Numero di telefono') }}</label>

                                              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                  <input id="customer_phone_number" type="text" class="form-control input-personal @error('customer_phone_number') is-invalid @enderror" name="customer_phone_number" value="" required autocomplete="customer_phone_number" autofocus>

                                                  @error('customer_phone_number')
                                                  <small class="text-danger">{{ $message }}</small>
                                                  @enderror
                                              </div>
                                          </div>

                                          <label for="amount">
                                              <span class="input-label"></span>
                                              <div class="input-wrapper amount-wrapper">
                                                  <input id="amount" name="amount" type="hidden" placeholder="Amount">
                                              </div>
                                          </label>

                                          <label for="order_details">
                                              <span class="input-label"></span>
                                              <div class="input-wrapper order_details-wrapper">
                                                  <input id="order_details" name="order_details" type="hidden" placeholder="order_details">
                                              </div>
                                          </label>

                                          <div class="bt-drop-in-wrapper">
                                              <div id="bt-dropin"></div>
                                          </div>
                                      </section>

                                      <input id="nonce" name="payment_method_nonce" type="hidden">

                                      <div class="form-group column mb-0">
                                          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 column">
                                              <button type="submit" class="my button my-button-orange">
                                                  {{ __('Completa ordine') }}
                                              </button>

                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- FINE ID APP DI VUE -->

  </section>
</main>
@endsection

@section('footer-scripts')
  @include('scripts.storeScripts')
  <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
  <script>
  var form = document.querySelector('#payment-form');
  var client_token = "{{$token}}";

  braintree.dropin.create({
      authorization: client_token,
      selector: '#bt-dropin',

  }, function(createErr, instance) {
      if (createErr) {
          console.log('Create Error', createErr);
          return;
      }


      form.addEventListener('submit', function(event) {

          event.preventDefault();

          instance.requestPaymentMethod(function(err, payload) {
              if (err) {
                  console.log('Request Payment Method Error', err);
                  return;
              }
              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;

              // get total amount from local storage
              var cart = localStorage.getItem('cart');
              var cartArray = JSON.parse(cart);
              var amount = 0;
              cartArray.forEach((item, i) => {
                  amount = amount + item.totalPrice;
              });

              // Add total amount to the form and submit
              document.querySelector('#amount').value = amount;

              document.querySelector('#order_details').value = localStorage.getItem('cart');


              form.submit();
          });
      });
  });
  </script>
  @include('scripts.appScripts')
@endsection
