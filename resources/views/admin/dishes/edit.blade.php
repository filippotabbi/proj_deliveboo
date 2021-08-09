@extends('layouts.app')

@section('main')
<main>
    <div class="container-fluid banner-show-homepage banner-show-user" style="background-image: url('/../images/varie/banner-deliveboo-admin.png')"></div>
    <section class="section-main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-8 col-xl-8">
                    <div class="">
                        <div class="col-md-12">
                            <div class="page-top">
                                <h1>Modifica piatto</h1>
                                <div class="my-buttons-container">
                                    <a class="my-button-responsive-show my-button-orange" href="{{route('admin.dishes.show', ['dish' => $dish->slug])}}">
                                        Torna al ristorante
                                    </a>

                                    <a class="my-button-responsive-hide my-button-orange" href="{{route('admin.dishes.show', ['dish' => $dish->slug])}}"><i class="fas fa-chevron-left"></i></a>
                                </div>

                            </div>
                        </div>


                            <form method="POST" action="{{ route('admin.dishes.update', ['dish' => $dish->id]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="form-group column d-none">
                                    <label for="name" class="col-md-4 col-form-label label-personal">Id Ristorante</label>

                                    <div class="col-md-12">
                                        <input id="restaurant_id" type="text" class="form-control @error('restaurant_id') is-invalid @enderror" name="restaurant_id" value="{{ old('restaurant_id', $dish->restaurant_id) }}" required autocomplete="restaurant_id" autofocus readonly>
                                    </div>
                                </div>

                                <div class="form-group column">
                                    <label for="name" class="col-md-4 col-form-label label-personal">{{ __('Nome') }}</label>

                                    <div class="col-md-12">
                                        <input id="name" type="text" class="form-control input-personal @error('name') is-invalid @enderror" name="name" value="{{ old('name', $dish->name) }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group column">
                                    <label for="price" class="col-md-4 col-form-label label-personal">{{ __('Prezzo') }}</label>

                                    <div class="col-md-12">
                                        <input id="price" type="number" class="form-control input-personal @error('price') is-invalid @enderror" name="price" value="{{ old('price', $dish->price) }}" required autocomplete="price" autofocus step="0.01">

                                        @error('price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group column">
                                    <label for="description" class="col-md-4 col-form-label label-personal">{{ __('Descrizione') }}</label>

                                    <div class="col-md-12">
                                        <textarea id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description">{{ old('description', $dish->description) }}</textarea>

                                          @error('description')
                                              <small class="text-danger">{{ $message }}</small>
                                          @enderror
                                    </div>
                                </div>

                                <div class="form-group column">
                                    <div class="col-md-12">
                                        <label for="image" class="label-personal">Immagine</label>
                                        <img src="{{asset($dish->image)}}" style="height: 50px;" alt="">
                                        <input class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" type="file">
                                        @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- INSERIRE DISPONIBILITA PIATTO --}}
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="available" class="label-personal">Disponibilità</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="available" value=1 {{ $dish['available'] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Si</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="available" value=0 {{ $dish['available'] == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2">No</label>
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group column mb-0">
                                    <div class="col-md-12 column">
                                        <button type="submit" class="my button my-button-orange">
                                            {{ __('Modifica questo piatto') }}
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
