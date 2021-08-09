@extends('layouts.app')

@section('main')
<main>
    <div class="container-fluid banner-show-homepage banner-show-user"
        style="background-image: url('../images/varie/deliveboo-jumbo.png')"></div>
    <section class="section-main position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-6">
                    <div class="checkout-card">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="page-top">
                                    <h2>Ciao {{ $user->name }} {{ $user->lastname }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="checkout-card-inner">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Informazioni personali</h6>
                                    <div class="row">
                                        <div class="col-sm-6 m-b-25">
                                            <p class="m-b-10 f-w-600">Email</p>
                                            <h6 class="user-text-muted f-w-400">{{ $user->email }}</h6>
                                        </div>
                                        <div class="col-sm-6 m-b-25">
                                            <p class="m-b-10 f-w-600">Password</p>
                                            <h6 class="user-text-muted f-w-400">**********</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 m-b-25">
                                            <p class="m-b-10 f-w-600">Partita IVA</p>
                                            <h6 class="user-text-muted f-w-400">{{ $user->p_iva }}</h6>
                                        </div>
                                        <div class="col-sm-6 m-b-25">
                                            <p class="m-b-10 f-w-600">Creato il</p>
                                            <h6 class="user-text-muted f-w-400">{{ $user->created_at }}</h6>
                                        </div>
                                    </div>
                                    <div class="user-buttons user-card-block">
                                        <a class="my-button-orange" href="{{ route('admin.restaurants.index') }}">I
                                            miei ristoranti</a>
                                        <a class="my-button-orange m-t-40" href="{{ route('index') }}">Torna alla
                                            Homepage</a>
                                    </div>
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
