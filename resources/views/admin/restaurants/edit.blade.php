@extends('layouts.app')

@section('main')
<main>
    <div class="container-fluid banner-show-homepage banner-show-user" style="background-image: url('/../images/varie/banner-deliveboo-admin.png')"></div>
    <section class="section-main">
        <div class="container" id="root">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-8 col-xl-8">
                    <div class="">
                        <div class="col-md-12">
                            <div class="page-top">
                                <h1>Modifica ristorante</h1>

                                <div class="my-buttons-container">
                                    <a class="my-button-responsive-show my-button-orange" href="{{route('admin.restaurants.show', ['restaurant' => $restaurant->slug])}}">
                                        Torna al ristorante
                                    </a>

                                    <a class="my-button-responsive-hide my-button-orange" href="{{route('admin.restaurants.show', ['restaurant' => $restaurant->slug])}}"><i class="fas fa-chevron-left"></i></a>
                                </div>
                            </div>
                        </div>


                            <form method="POST" action="{{ route('admin.restaurants.update', ['restaurant' => $restaurant->id]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="form-group column">
                                    <label for="name" class="col-md-4 col-form-label label-personal">{{ __('Nome') }}</label>

                                    <div class="col-md-12">
                                        <input id="name" type="text" class="form-control input-personal @error('name') is-invalid @enderror" name="name" value="{{ old('name', $restaurant->name) }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group column">
                                    <label for="address" class="col-md-4 col-form-label label-personal">{{ __('Indirizzo') }}</label>

                                    <div class="col-md-12">
                                        <input id="address" type="text" class="form-control input-personal @error('address') is-invalid @enderror" name="address" value="{{ old('address', $restaurant->address) }}" required autocomplete="address" autofocus>

                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group column">
                                    <label for="description" class="col-md-4 col-form-label label-personal">{{ __('Descrizione') }}</label>

                                    <div class="col-md-12">
                                        <textarea id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description">{{ old('description', $restaurant->description) }}</textarea>

                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group column pos-rel">
                                    <label for="categories" class="col-md-4 col-form-label label-personal">{{ __('Categoria') }}</label>
                                    <div class="col-md-12">
                                        <div class="selectBox">
                                            <select>
                                                <option>Scegli</option>
                                            </select>
                                            <div class="overSelect" v-on:click="checkReverse()"></div>
                                        </div>
                                        <div :class="(checkClick == true) ? 'show-this' : 'hide-this' ">
                                            @foreach ($categories as $index => $category)
                                              <label>
                                                  <input type="checkbox" name="category_ids[]" value="{{$category->id}}" {{ $restaurant->categories->contains($category) ? 'checked' : '' }}/>{{$category->name}}</label>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

                                <!-- upload logo -->
                                <div class="form-group column">
                                    <div class="col-md-12">
                                        <label for="logo" class="label-personal">Logo</label>
                                        <input class="form-control-file @error('logo') is-invalid @enderror" id="logo" name="logo" type="file">
                                        @error('logo')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                                <!-- upload logo -->
                                <!-- upload file banner -->
                                <div class="form-group column">
                                    <div class="col-md-12">
                                        <label for="banner" class="label-personal">Banner</label>
                                        <input class="form-control-file @error('banner') is-invalid @enderror" id="banner" name="banner" type="file">
                                        @error('banner')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group column mb-0">
                                    <div class="col-md-12 column">
                                        <button type="submit" class="my button my-button-orange">
                                            {{ __('Modifica questo Ristorante') }}
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

@section('footer-scripts')
  @include('scripts.restaurantScripts')
@endsection
