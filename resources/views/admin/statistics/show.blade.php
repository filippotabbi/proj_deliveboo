@extends('layouts.app')

@section('main')
<main>
  <div class="container-fluid banner-show-confirmation banner-show-user"
      style="background-image: url('/../images/varie/deliveboo-statistiche.png')"></div>
  <section class="section-main">
      <div class="container" id='stats'>
          <div class="row">
              <div class="col-md-12">
                  <div class="page-top">
                      <h1>Statistiche</h1>

                      <div class="my-buttons-container">
                          <a class="my-button-responsive-show my-button-orange"
                              href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->slug]) }}">Torna
                              al ristorante</a>
                          <a class="my-button my-button-blue mr-1"
                              href="{{ route('admin.orders.show', ['restaurant' => $restaurant->slug]) }}">Ordini
                              ricevuti</a>
                      </div>
                  </div>
              </div>
          </div>

          <div class="row">

              <select class="bg-dark text-light mb-5 m-auto" style="padding: 6px 10px; border-radius: 5px;"
                  v-model="year" @change="filterByYear">
                  <option value="2021">Anno 2021</option>
              </select>
          </div>

          <div class="row w-chart">
              <canvas id="chart" class="mychart my-5"></canvas>
          </div>
      </div>
  </section>
</main>
@endsection

@section('footer-scripts')
  <script>
      var id = {!! json_encode($restaurant->id) !!};
  </script>
  @include('scripts.chartScripts')
@endsection
