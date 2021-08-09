@extends('layouts.app')

@section('main')
<main>
    <div class="container-fluid banner-show-homepage banner-show-user" style="background-image: url('../../images/varie/banner-deliveboo-login-register.png')"></div>
    <section class="section-main margin-y-50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-8 col-xl-8">
                    <div class="">
                        <div class="col-md-12">
                            <div class="page-top">
                                <h1>Accedi a Deliveboo</h1>
                            </div>
                        </div>


                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group column">
                                    <label for="email" class="col-md-12 col-form-label label-personal">{{ __('Indirizzo e-mail') }}</label>

                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control input-personal @error('name') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group column">
                                    <label for="password" class="col-md-12 col-form-label label-personal">{{ __('Password') }}</label>

                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control input-personal @error('name') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="current-password" autofocus>

                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group column">
                                    <div class="col-md-12">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Rimani connesso') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group column mb-0">
                                    <div class="col-md-12 column">
                                        <button type="submit" class="my button my-button-orange">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                              <a class="btn btn-link btn-link-login" href="{{ route('password.request') }}">
                                                  {{ __('Password dimenticata?') }}
                                              </a>
                                          @endif

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
