@extends('layouts.main-layout')

{{-- @section('header')
  @include('partials.header2')
@endsection --}}

@section('content')

<section id="section_user_apartment_list">



<div class="container">

    <div class="row justify-content-center">
      <div class="col-md-8 ">

        <h2 class="mt-4 mb-0 text-center bg-light pb-3 pt-3">Messaggi ricevuti</h2>

            @foreach ($messages as $message)

              <div class="card" data-card="{{$count=0}}">
              <div class="card-body">
                <div class="d-flex flex-row flex-wrap">

                    <div class="  pl-3 col-12 col-md-6 p-2 d-flex flex-column ">

                        <div class="border-bottom border-dark">
                          <h5 class=""> Messaggio ricevuto: {{ $message -> message }}
                            <br>
                            <small class="text-muted">Recapito: {{ $message -> email }} </small>
                          </h5>
                        </div>

                    </div>

                </div>
              </div>
            </div>

          @endforeach

        </div>
     </div>

  </div>

</section>

@endsection
