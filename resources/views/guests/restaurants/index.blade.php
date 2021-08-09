@extends('layouts.app')

@section('main')
    <main id="root">
        <div class="container-fluid banner-show-homepage"
            style="background-image: url('../images/varie/deliveboo-jumbo.png')">
            <div class="container search-bar">
                <label for="Ricerca Ristoranti"></label>
                <input v-model="scriviTxt" class="search" type="search" name="search" @keyup.enter="cerca(scriviTxt)"
                    placeholder="Dove vuoi ordinare oggi?">
                <a class="my-button my-button-orange" style="cursor: pointer; margin-left: 15px;" @click="cerca(scriviTxt)">
                    Cerca
                </a>
            </div>
        </div>
        <section class="section-main">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="row row-categories">
                            <div class="card-homepage mb-2 text-center" v-for="category in categories" :key="category.id"
                                @onClick="categoryFilter()">
                                <input class="checkbox-categories" type="checkbox" :id="category.name" :value="category.id">
                                <label class="checkbox-categories-label" :for="category.name"
                                    @click="filterRestaurants(category.id)">
                                    <img class="icon-category" :src="category.icon"
                                        :class="(categorySelected == category.id) ? 'checkbox-categories-label-checked': ''">
                                    <h5>@{{ category . name }}</h5>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="results-title">
                    <h2 v-if="searchResult.length == 0 && filterResult.length == 0 && results.length != 0">
                        I nostri ristoranti</h2>
                    <h2 v-if="searchResult.length > 0 || filterResult.length > 0 || results.length == 0">
                        Risultati della ricerca</h2>
                    <button v-if="searchResult.length > 0 || filterResult.length > 0 || results.length == 0" type="button"
                        name="button" class="my-button my-button-orange" @click="restart">
                        Tutti ristoranti
                    </button>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 col-lg-4 mt-2 card-outline" v-for="result in displayedResults"
                                :key="result.id">
                                <a class="link-to" :href="'restaurants/' + result.slug">
                                    <div class="card-personal">
                                        <div class="card-personal-cover"
                                            :style="`background-image: url('${result.banner}') ; `">
                                            <img :src="result.logo">
                                            <div class="overlay"></div>
                                        </div>
                                        <div class="card-personal-title">
                                            <h4>@{{ result . name }}</h4>
                                            <div class="restaurant-cat">
                                                <img :src="category.icon" v-for="category in result.categories"
                                                    alt="category.name" class="ml-1">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="no-results text-center col-md-12 col-lg-12"
                                :class="(searchResult.length == 0 && filterResult.length == 0 && results.length == 0) ? 'd-block' : ''">
                                <h4 class="mt-2">Ops... nessun risultato</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" v-if="pages.length > 1">
                        <nav>
                            <ul class="pagination justify-content-center pt-5">
                                <li class="page-item" :class="(page == pages[0]) ? 'disabled' : ''">
                                    <button type="button" class="page-link" @click="page--;">
                                        Precedente
                                    </button>
                                </li>
                                <li class="page-item">
                                    <button type="button" class="page-link" v-for="pageNumber in pages"
                                        :class="(page == pageNumber) ? 'active-pagination' : '' "
                                        @click="page = pageNumber"> @{{ pageNumber }}</button>
                                </li>
                                <li class="page-item" :class="(page == pages.length) ? 'disabled' : ''">
                                    <button type="button" @click="page++" class="page-link">
                                        Successivo
                                    </button>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('footer-scripts')
  @include('scripts.restaurantScripts')
@endsection
