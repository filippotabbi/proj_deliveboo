@extends('layouts.app')

@section('main')
<main>
    <div class="container-fluid banner-show-homepage banner-show-user" style="background-image: url('../../images/varie/banner-deliveboo-login-register.png')"></div>
    <section class="section-main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-8 col-xl-8">
                    <div class="">
                        <div class="col-md-12">
                            <div class="page-top">
                                <h1>Entra in DeliveBoo</h1>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group column">
                                <label for="name" class="col-md-4 col-form-label label-personal">{{ __('Nome') }}</label>

                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control input-personal @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group column">
                                <label for="lastname" class="col-md-4 col-form-label label-personal">{{ __('Cognome') }}</label>

                                <div class="col-md-12">
                                    <input id="lastname" type="text" class="form-control input-personal @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                    @error('lastname')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group column">
                                <label for="p_iva" class="col-md-4 col-form-label label-personal">{{ __('Partita IVA') }}</label>

                                <div class="col-md-12">
                                    <input id="p_iva" type="number" class="form-control input-personal @error('p_iva') is-invalid @enderror" name="p_iva" value="{{ old('p_iva') }}" required autocomplete="p_iva" autofocus step="0.01">

                                    @error('p_iva')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group column">
                                <label for="email" class="col-md-4 col-form-label label-personal">{{ __('Indirizzo e-mail') }}</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control input-personal @error('name') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group column">
                                <label for="password" class="col-md-4 col-form-label label-personal">{{ __('Password') }}</label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control input-personal @error('name') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="new-password" autofocus>

                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group column">
                                <label for="password-confirm" class="col-md-4 col-form-label label-personal">{{ __('Conferma password') }}</label>

                                <div class="col-md-12">

                                    <input id="password-confirm" type="password" class="form-control input-personal"
                                                name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group column mb-0">
                                <div class="col-md-12 column">
                                    <button type="submit" class="my button my-button-orange">
                                        {{ __('Completa registrazione') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
