@extends('layouts.app')

@section('main')
<main>
    <div class="container-fluid banner-show" style="background-image: url('{{ asset($restaurant->banner) }}')"></div>
    <section class="section-main position-relative" id="root">
        <div class="container padding-y-50">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-6">
                    <div class="checkout-card show-dish">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="page-top">
                                    <h2>{{ $dish['name'] }}</h2>
                                    <a class="my-button-responsive-show my-button-orange"
                                        href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->slug]) }}">Torna
                                        al ristorante</a>
                                    <a class="my-button-responsive-hide my-button-orange"
                                        href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->slug]) }}"><i
                                            class="fas fa-chevron-left"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="row show-dish-image justify-content-center checkout-card-inner">
                            <div class="col-md-12 d-flex justify-content-center">
                                <div class="show-dish-banner"
                                    style="background-image: url('{{ asset($dish->image) }}')"></div>


                            </div>
                        </div>
                        <div class="row checkout-card-inner">
                            <div class="col-md-6">
                                <h4 class="mb-2">Descrizione</h4>
                                <span>{{ $dish['description'] }}</span>


                            </div>
                            <div class="col-md-6 d-flex justify-content-end align-items-center">
                                <h4>€{{ $dish['price'] }} <i class="fas fa-circle"
                                        :class="({{ $dish->available }} == 1) ? 'text-green' : 'text-red' "></i></h4>
                            </div>
                        </div>
                        <div class="row checkout-card-inner justify-content-center">
                            <a class="my-button-responsive-show my-button-blue mr-2"
                                href="{{ route('admin.dishes.edit', ['dish' => $dish->slug]) }}">Modifica piatto</a>
                            <a class="my-button-responsive-show my-button-red ml-2" name="button"
                                @click="deleteForm = true">Cancella piatto</a>

                            {{-- buttons che appaiono solo su tablet/mobile --}}
                            <a class="my-button-responsive-hide my-button-blue mr-2"
                                href="{{ route('admin.dishes.edit', ['dish' => $dish->slug]) }}"><i
                                    class="fas fa-edit"></i></a>
                            <a class="my-button-responsive-hide my-button-red ml-2" name="button"
                                @click="deleteForm = true"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Delete pop up -->
        <div class="delete-container" :class="(deleteForm ? 'd-flex' : '')">
            <div class="delete-form">
                <h4>Vuoi cancellare il piatto</h4>
                <br>
                <h4>{{ $dish->name }}?</h4>
                <img src="{{ asset($dish->image) }}" alt="{{ $dish->name }}">
                <div class="buttons mt-3">
                    <form class="d-inline" action="{{ route('admin.dishes.destroy', ['dish' => $dish->id]) }}"
                        method="post">
                        @csrf
                        @method('DELETE')
                        <input class="my-button my-button-red" type="submit" value="Cancella"
                            style="padding: 10px 25px;">
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
