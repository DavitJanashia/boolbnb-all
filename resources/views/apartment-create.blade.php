@extends('layouts.main-layout')
{{-- @section('header')
  @include('partials.header2')
@endsection --}}


@section('content')




  <section id="section_create" class="pt-5">

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-md-8 pad-t100">
        <div id="mycreate" class="card mt-5 mb-5">

          <div class="card-header">
            <h1 class="text-center">Aggiungi un annuncio</h1>
          </div>

              <div class="card-body">
                <form action="{{route('apart.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('POST')

                  <div class="form-group">
                <label class="col-md-4 col-form-label text-md-right" for="description">Descrizione appartamento</label>
                <input id="create_description" type="text" class=" @error('description') is-invalid @enderror col-md-6" name="description" value="{{ old('description') }}"  required autocomplete="description" autofocus >
                  @error('description')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              <div class="form-group">
                <label class="col-md-4 col-form-label text-md-right" for="number_of_rooms">Numero di stanze</label>
                <input id="create_number_of_rooms" type="number" class=" @error('number_of_rooms') is-invalid @enderror col-md-6" name="number_of_rooms"  value="{{ old('number_of_rooms') }}" required autocomplete="number_of_rooms" autofocus>
                @error('number_of_rooms')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label class="col-md-4 col-form-label text-md-right" for="number_of_beds">Numero di letti</label>
                <input id="create_number_of_beds" type="number" class=" @error('number_of_beds') is-invalid @enderror col-md-6" name="number_of_beds" value="{{ old('number_of_beds') }}"  required autocomplete="number_of_beds" autofocus>
                @error('number_of_beds')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label class="col-md-4 col-form-label text-md-right" for="number_of_bathrooms">Numero di bagni</label>
                <input id="create_number_of_bathrooms" type="number" class=" @error('number_of_bathrooms') is-invalid @enderror col-md-6" name="number_of_bathrooms" value="{{ old('number_of_bathrooms') }}"  required autocomplete="number_of_bathrooms" autofocus>
                @error('number_of_bathrooms')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label class="col-md-4 col-form-label text-md-right" for="square_meters">Metri quadri</label>
                <input id="create_square_meters" type="number" class=" @error('square_meters') is-invalid @enderror col-md-6" name="square_meters" value="{{ old('square_meters') }}"  required autocomplete="square_meters" autofocus>
                @error('square_meters')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              {{-- ----------- form senza autocomplete - -validazione ------------------------ --}}

              {{-- <div class="form-group">
                <label class="col-md-4 col-form-label text-md-right" for="address">Digitare indirizzo</label>
                <input id="address" type="text" class=" @error('address') is-invalid @enderror col-md-6" name="address" value="{{ old('address') }}"  required autocomplete="address" autofocus>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div> --}}

              {{-- <div class="form-group">
                <label class="col-md-4 col-form-label text-md-right" for="city">Città</label>
                <input id="city" type="text" class=" @error('city') is-invalid @enderror col-md-6" name="city"  value="{{ old('city') }}" required autocomplete="city" autofocus>
                @error('city')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div> --}}

              {{-- <div class="form-group">
                <label class="col-md-4 col-form-label text-md-right" for="state">Paese</label>
                <input id="state" type="text" class=" @error('state') is-invalid @enderror col-md-6" name="state" value="{{ old('state') }}" required autocomplete="state" autofocus>
                @error('state')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div> --}}

              {{-- ----------- form senza -validazione -AUTOCOMPILAZIONE----------------------- --}}

              <div class="form-group">
                <label class="col-md-4 col-form-label text-md-right" for="address">Indirizzo</label>
                <input id="create_address" type="text" class=" col-md-6" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus  />

                <label class="col-md-4 col-form-label text-md-right" for="city">Citta</label>
                <input id="create_city" type="text" class=" col-md-6" name="city" value="{{ old('city') }}" autofocus  readonly />

                <label class="col-md-4 col-form-label text-md-right" for="state">Paese</label>
                <input id="create_state" type="text" class=" col-md-6" name="state" value="{{ old('state') }}" autofocus  readonly />

                <label class="col-md-4 col-form-label text-md-right" for="zipcode">ZipCode</label>
                <input id="create_zipcode" type="text" class=" col-md-6" name="zipcode" value="{{ old('zipcode') }}" autofocus  readonly />

                <label class=" invisible col-md-4 col-form-label text-md-right" for="lat"> LAt </label>
                <input id="create_lat" type="text" class=" invisible col-md-6" value="{{ old('lat') }}"  name="lat"  autofocus  readonly />

                <label class=" invisible col-md-4 col-form-label text-md-right" for="lng"> Long</label>
                <input id="create_lng" type="text" class=" invisible col-md-6" value="{{ old('lng') }}" name="lng"  autofocus  readonly />
              </div>







              <div class="create form-group">
                <label class="col-md-4 col-form-label text-md-right" for="image_path[]">Select Image</label>

                <div class="imgCreatePreview mb-3"></div>

                <input id="img-inp" type="file" class="form-control-file
                                    @error('image_path.*') is-invalid @enderror col-md-6"  name="image_path[]" id="images" multiple="multiple">

                                    @error('image_path.*')
                                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror

              </div>


              <h3 id="my-serv-ag" class="text-center">Servizi aggiuntivi</h3>

              <div id="serv-agiunt">
                <div class="form-group">
                  <label for="wifi">WIFI</label>
                  <input type="checkbox" name="wifi"
                    @if  (old('wifi'))  checked @endif  value="1">

                </div>
                <div class="form-group">
                  <label for="parking">Parcheggio</label>
                  <input type="checkbox" name="parking"
                    @if  (old('parking'))  checked @endif value="2">
                </div>
                <div class="form-group">
                  <label for="sauna">Sauna</label>
                  <input type="checkbox" name="sauna"
                    @if  (old('sauna'))  checked @endif value="3">

                </div>
                <div class="form-group">
                  <label for="sea_view">Vista mare</label>
                  <input type="checkbox" name="sea_view"
                    @if  (old('sea_view'))  checked @endif value="4">
                </div>
                <div class="form-group">
                  <label for="pool">Piscina</label>
                  <input type="checkbox" name="pool"
                    @if  (old('pool'))  checked @endif value="5">
                </div>
                <div class="form-group">
                  <label for="reception">Reception</label>
                  <input type="checkbox" name="reception"
                    @if  (old('reception'))  checked @endif value="6">

                </div>
              </div>

              <button id="mycreate-btn" class="btn btn-primary" type="submit" name="button">Crea</button>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
<script type="text/javascript" src="js/app3.js"></script>
</section>
@endsection
