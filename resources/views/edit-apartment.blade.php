@extends('layouts.main-layout')
{{-- @section('header')
  @include('partials.header2')
@endsection --}}

@section('content')

<section id="section_edit" class="pt-5">

<div class="container">

  <div class="row justify-content-center">
    <div class="col-md-8">
      <div id="myedit" class="card mt-5 mb-5">
        <div class="card-header">
          <h1 class="text-center">Modifica informazioni riguardanti il tuo appartamento</h1>
        </div>
        <div class="card-body">
          <form action="{{route('apart.update',$apart -> id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="form-group">
                  <label class="col-md-4 col-form-label text-md-right" for="description">Descrizione appartamento</label>
                  <input id="edit_description" type="text" class=" @error('description') is-invalid @enderror col-md-6" name="description" value="{{$apart -> description}}" required autocomplete="description" autofocus >
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label class="col-md-4 col-form-label text-md-right" for="number_of_rooms">Numero di stanze</label>
                  <input id="edit_number_of_rooms" type="number" class=" @error('number_of_rooms') is-invalid @enderror col-md-6" name="number_of_rooms" value="{{$apart -> number_of_rooms}}" required autocomplete="number_of_rooms" autofocus>
                  @error('number_of_rooms')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="col-md-4 col-form-label text-md-right" for="number_of_beds">Numero di letti</label>
                  <input id="edit_number_of_beds" type="number" class=" @error('number_of_beds') is-invalid @enderror col-md-6" name="number_of_beds" value="{{$apart -> number_of_beds}}" required autocomplete="number_of_beds" autofocus>
                  @error('number_of_beds')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="col-md-4 col-form-label text-md-right" for="number_of_bathrooms">Numero di bagni</label>
                  <input id="edit_number_of_bathrooms" type="number" class=" @error('number_of_bathrooms') is-invalid @enderror col-md-6" name="number_of_bathrooms" value="{{$apart -> number_of_bathrooms}}" required autocomplete="number_of_bathrooms" autofocus>
                  @error('number_of_bathrooms')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="col-md-4 col-form-label text-md-right" for="square_meters">Metri quadri</label>
                  <input id="edit_square_meters" type="number" class=" @error('square_meters') is-invalid @enderror col-md-6" name="square_meters" value="{{$apart -> square_meters}}" required autocomplete="square_meters" autofocus>
                  @error('square_meters')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="col-md-4 col-form-label text-md-right" for="address">Indirizzo</label>
                  <input id="edit_address" type="text" class=" @error('address') is-invalid @enderror col-md-6" name="address" value="{{$apart -> address}}" autocomplete="address" autofocus  />
                  @error('address')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                {{-- </div>
                <div class="form-group"> --}}
                  {{-- <label class="col-md-4 col-form-label text-md-right" for="city">Città</label>
                  <input id="edit_city" type="text" class=" @error('city') is-invalid @enderror col-md-6" name="city" value="{{$apart -> city}}"  autocomplete="city" autofocus readonly>
                  @error('city')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror --}}
                {{-- </div>
                <div class="form-group"> --}}
                  {{-- <label class="col-md-4 col-form-label text-md-right" for="state">Paese</label>
                  <input id="edit_state" type="text" class=" @error('state') is-invalid @enderror col-md-6" name="state" value="{{$apart -> state}}" autocomplete="state" autofocus readonly>
                  @error('state')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror --}}
{{--
                  <label class="col-md-4 col-form-label text-md-right" for="zipcode">ZipCode</label>

                  <input id="edit_zipcode" type="text" class=" @error('zipcode') is-invalid @enderror col-md-6" name="zipcode" autocomplete="state" autofocus readonly>
                  @error('zipcode')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror --}}

                  <label class="col-md-4 col-form-label text-md-right"  for="city">Città</label>
                    <input id="edit_city" type="text" class=" col-md-6" value="{{$apart -> city}}" name="city"  autofocus  readonly />

                  <label class="col-md-4 col-form-label text-md-right"  for="state">Stato</label>
                    <input id="edit_state" type="text" class=" col-md-6" value="{{$apart -> state}}" name="state"  autofocus  readonly />

                  <label class="col-md-4 col-form-label text-md-right" for="zipcode">ZipCode</label>
                  <input id="edit_zipcode" type="text" class=" col-md-6" name="lat"  autofocus  readonly />

                  <label class=" invisible col-md-4 col-form-label text-md-right" for="lat">Lat - Invisibile</label>
                  <input id="edit_lat" type="text" class="invisible col-md-6" value="{{$apart -> lat}}"  name="lat"  autofocus  readonly />

                  <label class=" invisible col-md-4 col-form-label text-md-right" for="lat">Long - Invisibile</label>
                  <input id="edit_lng" type="text" class="invisible col-md-6" value="{{$apart -> lng}}"  name="lng"  autofocus  readonly />
                </div>

              <div class="form-group">

                  @foreach ($apart->images as $image)

                    <div class="row">
                      <div class=" mt-2 ml-2 mb-2 stored-image col-md-6">
                        <img src="{{asset($image->image_path)}}" alt="{{$image->image_path}}">
                      </div>
                      <div class="edit-button-delete col-md-2">
                          <a class=" mt-2 ml-3 mb-2 btn btn-danger" href="{{route('destroy', $image->id)}}" data-input = "{{asset($image->image_path)}}" type="button" name="button">Delete</a>
                      </div>
                    </div>
                  @endforeach

                  </div>

                    <div id="form-img-layout" class="edit form-group">

                        <label for="image_path[]">Image/file</label>

                        <div class="imgEditPreview mb-3"></div>

                        <input type="file" name="image_path[]" id="images" class="@error('image_path.*') is-invalid @enderror col-md-6" multiple="multiple">

                        @error('image_path.*')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror


                        {{-- @if($errors->has('image_path'))

                        <span class="help-block text-danger">{{ $errors->first('image_path') }}</span>
                        @endif --}}
                </div>


            <h3 class="text-center">Servizi aggiuntivi</h3>
            <div id="serv-agiunt">
              <div class="form-group">
                <label for="wifi">WIFI</label>
                <input type="checkbox" name="wifi"

                @foreach ($services as $service)
                  @if ($service->id == 1)
                    checked
                  @endif
                @endforeach

                value="1">
              </div>

              <div class="form-group">
                <label for="parking">Parcheggio</label>
                <input type="checkbox" name="parking"

                @foreach ($services as $service)
                  @if ($service->id == 2)
                    checked
                  @endif
                @endforeach

                value="2">
              </div>

              <div class="form-group">
                <label for="sauna">Sauna</label>
                <input type="checkbox" name="sauna"

                @foreach ($services as $service)
                  @if ($service->id == 3)
                    checked
                  @endif
                @endforeach

                value="3">
              </div>

              <div class="form-group">
                <label for="sea_view">Vista mare</label>
                <input type="checkbox" name="sea_view"

                @foreach ($services as $service)
                  @if ($service->id == 4)
                    checked
                  @endif
                @endforeach

                value="4">
              </div>

              <div class="form-group">
                <label for="pool">Piscina</label>
                <input type="checkbox" name="pool"

                @foreach ($services as $service)
                  @if ($service->id == 5)
                    checked
                  @endif
                @endforeach

                value="5">
              </div>

              <div class="form-group">
                <label for="reception">Reception</label>
                <input type="checkbox" name="reception"

                @foreach ($services as $service)
                  @if ($service->id == 6)
                    checked
                  @endif
                @endforeach

                value="6">
              </div>
            </div>


            <button id="myupdate-btn" class="btn btn-primary" type="submit" name="button">Aggiorna</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="../js/app4.js"></script>
<!-- <script type="text/javascript" src="js/app4.js"></script> -->
</section>
@endsection
