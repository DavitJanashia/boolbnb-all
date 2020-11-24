@extends('layouts.main-layout')

{{-- @section('header')
  @include('partials.header2')
@endsection --}}

@section('content')

<section id="section_user_apartment_list">



<div class="container">

    <div class="row justify-content-center">
      <div class="col-md-8 ">

        <h2 class="mt-4 text-center bg-light pb-3 pt-3   mb-sm-2 mb-md-2 mb-lg-0">I miei annunci</h2>

            @foreach ($aparts as $apart)

              <div class="card mb-sm-2 mb-md-2 mb-lg-0
              @if (($apart -> visibility) == 0)
              notVisibleGuest
              @endif
              " data-card="{{$count=0}}">
              <div class="card-body">
                <div class="d-flex flex-row flex-wrap">
                  <div class="mycarousel list">
                    <div class="carousel-container">

                      @foreach ($apart->images as $image)
                        <div class="carousel-images  @if ($count==0) active  @endif
                        " data-id="{{$count++}}">

                            <img src="{{asset($image->image_path)}}" alt="{{$image->image_path}}">

                        </div>

                      @endforeach
                    </div>

                    <div class="invisible prev"><i class="fas fa-chevron-circle-left"></i> </div>
                    <div class="invisible next"><i class="fas fa-chevron-circle-right"></i> </div>


                  </div>






                    <div class="  mt-3 pl-3 col-lg-6 p-2 d-flex flex-column ">

                        <div class="border-bottom border-dark">
                          <h5 class="">{{ $apart -> description }} @if (($apart -> visibility) == 0) : Non disponibile @endif
                            <br>
                            <small class="text-muted"> {{ $apart -> address }} - {{ $apart -> city }} - {{ $apart -> state }}  </small>
                          </h5>
                        </div>

                        <div class="flex-grow-1 text-secondary">
                          <div class="pt-2">
                            <span> {{ $apart -> square_meters }} mq  </span>
                        </div>
                          <div class="">
                            <span class="pt-2"> Stanze: {{ $apart -> number_of_rooms }} </span>
                          </div>
                          <div class="">
                            <span class="pt-2"> Letti: {{ $apart -> number_of_beds }}  </span>
                          </div>
                        </div>

                        <div class="mt-auto text-secondary">

                          {{-- <a class="btn btn-light" href="#">Dettagli</a>
                          <a class="btn btn-light" href="{{route('apart.edit',$apart -> id)}}">Modifica</a> --}}

                          <a class="btn btn-light" href="{{route('apart.show',$apart -> id)}}">Show</a>
                          <a class="btn btn-light" href="{{route('apart.edit',$apart -> id)}}">Edit</a>
                          <a data-id="{{$apart -> id}}" class="btn btn-light deleteAlgolia" href="{{route('apart.delete', $apart -> id)}}">Delete</a>
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
