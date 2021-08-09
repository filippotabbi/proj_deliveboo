@extends('layouts.app')

@section('main')
    <main>
        <div class="container-fluid banner-show-homepage banner-show-user"
            style="background-image: url('../images/varie/banner-deliveboo-admin.png')"></div>
        <section class="section-main">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="page-top">
                            {{-- <h3>Benvenuto {{ Auth::user()->name }}</h3> --}}
                            <h1>I miei ristoranti</h1>

                            <div class="my-buttons-container">
                                <a class="my-button-responsive-show my-button-orange "
                                    href="{{ route('admin.restaurants.create') }}">Crea ristorante</a>

                                {{-- button che appare su tablet/mobile --}}
                                <a class="my-button-responsive-hide my-button-orange"
                                    href="{{ route('admin.restaurants.create') }}"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    @foreach ($restaurants as $index => $restaurant)
                        <div class="col-md-6 col-lg-4 mt-2 card-outline">
                            <a class="link-to"
                                href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->slug]) }}">
                                <div class="card-personal">
                                    <div class="card-personal-cover"
                                        style="background-image: url('{{ asset($restaurant->banner) }}')">
                                        <img src="{{ asset($restaurant->logo) }}" alt="">
                                        <div class="overlay"></div>
                                    </div>
                                    <div class="card-personal-title">
                                        <h4>{{ $restaurant->name }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <div class="col-md-6 col-lg-4 mt-2 card-outline">
                        <a class="link-to" href="{{ route('admin.restaurants.create') }}">
                            <div class="card-personal">
                                <div class="card-personal-cover">
                                    <div class="add-card">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div class="overlay"></div>
                                </div>

                                <div class="card-personal-title">
                                    <h4>Crea ristorante</h4>
                                </div>

                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
