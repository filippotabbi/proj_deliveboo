@extends('layouts.app')

@section('main')
<main>
    <div class="container-fluid banner-show-confirmation"
        style="background-image: url('../images/varie/deliveboo-jumbo.png')"></div>
    <section class="section-main">
        <div class="container py-2">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5">
                    <div class="checkout-card">
                        <div class="page-top justify-content-center">
                            <h2>Transazione accettata!</h2>
                        </div>
                        <div class="checkout-card-inner" style="background-color: #fff">
                            <div class="confirmation">
                                <span class="text-uppercase">ID transazione: {{ $transaction }}.</span>
                                <p class="mb-4">Il ristorante ha ricevuto il tuo ordine</p>
                                <div class="order-code mb-3"
                                    style="background-image: url('../images/varie/noodles.gif')"></div>
                                <div class="mt-4 text-center">
                                    <a href="{{ route('index') }}" class="my-button-orange">Homepage</a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</main>
@endsection

@section('footer-scripts')
<script type="text/javascript">
    localStorage.clear();
</script>
@endsection
