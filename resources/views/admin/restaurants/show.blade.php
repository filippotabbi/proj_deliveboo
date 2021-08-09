@extends('layouts.app')

@section('main')
<main>
    <div class="container-fluid banner-show" style="background-image: url('{{ asset($restaurant->banner) }}')"></div>
    <section class="section-main position-relative" id="root">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="page-top">
                        <h1>{{ $restaurant['name'] }}</h1>
                        <div class="my-buttons-container">
                            <a class="my-button-responsive-show my-button-orange"
                                href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->slug]) }}">Modifica
                                ristorante</a>
                            <a class="my-button-responsive-show my-button-red" type="button" name="button"
                                @click="deleteForm = true">Cancella ristorante</a>

                            {{-- buttons che appaiono solo su tablet/mobile --}}
                            <a class="my-button-responsive-hide my-button-orange"
                                href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->slug]) }}"><i
                                    class="fas fa-edit"></i></a>
                            <a class="my-button-responsive-hide my-button-red " type="button" name="button"
                                @click="deleteForm = true"><i class="fas fa-trash-alt"></i></a>

                        </div>

                    </div>
                    <h2>I miei piatti</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 mt-2 card-outline">
                    <a class="link-to" href="{{ route('admin.dishes.create', ['restaurant' => $restaurant->slug]) }}">
                        <div class="card-personal">
                            <div class="card-personal-cover">
                                <div class="add-card">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="overlay"></div>
                            </div>

                            <div class="card-personal-title">
                                <h4>Crea piatto</h4>
                            </div>

                        </div>
                    </a>
                </div>

                @foreach ($dishes as $index => $dish)
                    <div class="col-md-6 col-lg-4 mt-2 card-outline">
                        <a class="link-to" href="{{ route('admin.dishes.show', ['dish' => $dish->slug]) }}">
                            <div class="card-personal">
                                <div class="card-personal-cover"
                                    style="background-image: url('{{ asset($dish->image) }}')">
                                </div>

                                <div class="card-personal-title">
                                    <h4>{{ $dish->name }}</h4>
                                    <div class="dish-price">
                                        <h5>€{{ $dish->price }}</h5>
                                        <i class="fas fa-circle"
                                            :class="({{ $dish->available }} == 1) ? 'text-green' : 'text-red' "></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-md-12">
                    <div class="my-buttons-container d-flex justify-content-center padding-top-54">
                        <a class="my-button my-button-blue mr-1"
                            href="{{ route('admin.orders.show', ['restaurant' => $restaurant->slug]) }}">Ordini
                            ricevuti</a>
                        <a class="my-button my-button-green ml-1"
                            href="{{ route('admin.statistics.show', ['restaurant' => $restaurant->slug]) }}">Statistiche</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete pop up -->
        <div class="delete-container" :class="(deleteForm ? 'd-flex' : '')">
            <div class="delete-form">
                <h4>Vuoi cancellare il ristorante </h4>
                <br>
                <h4>"{{ $restaurant->name }}"?</h4>
                <img src="{{ asset($restaurant->logo) }}" alt="{{ $restaurant->name }}">
                <div class="buttons mt-3">
                    <form class="d-inline"
                        action="{{ route('admin.restaurants.destroy', ['restaurant' => $restaurant->id]) }}"
                        method="post">
                        @csrf
                        @method('DELETE')
                        <input class="my-button my-button-red" type="submit" value="Cancella">
                    </form>
                    <a type="button" name="button" class="my-button my-button-green" @click="deleteForm = false">Torna
                        indietro</a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('footer-scripts')
  @include('scripts.restaurantScripts')
@endsection
