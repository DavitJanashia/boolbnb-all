@extends('layouts.main-layout')

@section('content')
<div class="container">
  <div id="div-search" class="flex mb-4 mt-0">
    <div class="white-radius-center r2">
      <input type="search" value="" name="places" id="mysearch" placeholder="Cerca">
    </div>
    <span id="mylatitude">{{$lat}}</span>
    <span id="mylongitude">{{$lng}}</span>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card mrg-t100">
        <div class="card-header">
          <h1 class="text-center">Risultati</h1>
        </div>


        <section class="col-md-12 map_section">
          <div class="right-column">
            <div id="mapApiGoogle"></div>
          </div>
          <div class="clear-both"></div>
        </section>

        <div id="slidecontainer">
          <p>Scegli il raggio in km:</p>
          <input id="mySliderRadius" type="range" min="1" max="100000" value="20000">

          <p>km: <span id="sliderValue"></span></p>
        </div>

        <div class=" pl-5 col-12">
          <label for="wifi">Wifi</label>
          <input id='wifiCheck' type="checkbox" name="wifi">

          <label for="parking">Parcheggio</label>
          <input id='parkingCheck' type="checkbox" name="parking">

          <label for="sauna">Sauna</label>
          <input id='saunaCheck' type="checkbox" name="sauna">

          <label for="sea_view">Vista Mare</label>
          <input id='seaCheck' type="checkbox" name="sea_view">

          <label for="pool">Piscina</label>
          <input id='poolCheck' type="checkbox" name="pool">

          <label for="reception">Reception</label>
          <input id='receptionCheck' type="checkbox" name="reception">
        </div>

        <!-- selezione numero minimo camere e letti -->
        <div class="searchOptions pl-5 col-12">
          <label for="min-rooms">Numero minimo di stanze</label>
            <select id="min-rooms" name="min-rooms">
              <option selected value="1"></option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">Maggiore di 6</option>
            </select>

            <label for="min-beds">Numero minimo di letti</label>
              <select id="min-beds" name="min-beds">
                <option selected value="1"></option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">Maggiore di 6</option>
              </select>
        </div>

        <ul id="hand-target-sponsorship">

          </ul>

        <ul id="hand-target">

          </ul>

        </div>
      </div>
    </div>
  </div>
</div>
<script id="handlebar-template" type="text/x-handlebars-template">
  <div class="card" data-card="{{$count=0}}">
    <div class="card-body">
      <div class="sponsored-label" class=""></div>
      <div class="d-flex flex-row flex-wrap">

        <img class="handelbar-img  mx-auto" src="@{{{ img }}}" alt="nophoto">

          <div class="  pl-3 col-12 col-md-6 p-2 d-flex flex-column ">

              <div class="border-bottom border-dark">
                <h5 class=""> <a href="apart/@{{ id }}">@{{{ description }}} </a>
                  <br>
                  <small class="text-muted"> @{{{ address }}} - @{{{ city }}} - @{{{ state }}}  </small>
                </h5>
              </div>

              <div class="flex-grow-1 text-secondary">
                <div class="pt-2">
                  <span> @{{{ square_meters }}} mq  </span>
              </div>
                <div class="">
                  <span class="pt-2"> Stanze: @{{{ number_of_rooms }}} </span>
                </div>
                <div class="">
                  <span class="pt-2"> Letti: @{{{ number_of_beds }}}  </span>
                </div>
              </div>


          </div>

      </div>
    </div>
  </div>
</script>

{{-- <script src="//cdn.jsdelivr.net/jquery/2.1.4/jquery.min.js"></script> --}}
<script src="//cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
<script src="//cdn.jsdelivr.net/algoliasearch.helper/2/algoliasearch.helper.min.js"></script>
<script src="//cdn.jsdelivr.net/hogan.js/3.0.2/hogan.min.common.js"></script>
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyAZctiuPDZMp28faClkz61dOcINbBikQDw"></script>

<script src="{{ asset('js/app2.js') }}" defer></script>
@endsection
