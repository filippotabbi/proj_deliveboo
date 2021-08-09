@extends('layouts.app')

@section('main')
<main>
    <div class="container-fluid banner-show-confirmation banner-show-user"
        style="background-image: url('/../images/varie/deliveboo-ordini.png')"></div>
    <section class="section-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-top">
                        <h1>Storico ordini</h1>

                        <div class="my-buttons-container">
                            <a class="my-button-responsive-show my-button-orange"
                                href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->slug]) }}">Torna
                                al ristorante</a>
                            <a class="my-button my-button-green mr-1"
                                href="{{ route('admin.statistics.show', ['restaurant' => $restaurant->slug]) }}">Statistiche</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div id="history" class="col-sm-12 padding-y-30">
                    <div class="height-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="th-sm">NOME

                                    </th>
                                    <th class="th-sm">N.TELEFONO

                                    </th>
                                    <th class="th-sm">INDIRIZZO

                                    </th>
                                    <th class="th-sm">DATA

                                    </th>
                                    <th class="th-sm">TOTALE

                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr class="t-row" v-for="post in displayedPosts" :key="post.id">
                                    <td>@{{ post . customer_name }}
                                        @{{ post . customer_lastname }}</td>
                                    <td>@{{ post . customer_phone_number }}</td>
                                    <td>@{{ post . customer_address }} </td>
                                    <td>@{{ getDay(post . created_at) }}
                                        H:@{{ getTime(post . created_at) }} </td>
                                    <td>€@{{ post . total_price }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
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
  <script>
      var id = {!! json_encode($restaurant->id) !!};
  </script>
  @include('scripts.orderhistoryScripts')
@endsection
