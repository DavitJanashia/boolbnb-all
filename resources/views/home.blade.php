@extends('layouts.main-layout')
{{-- @section('header')
  @include('partials.header1')
@endsection --}}
@section('content')

  <section id="section_home">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex justify-content-center">
          <div id="my_dashboard" class="mrg-t200 mt-5 r card position-fixed mt-4 flex">
            <div class="card-header ">{{ __('Dashboard') }}</div>

              <div class="card-body ">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif

                  {{ __('You are logged in!') }}
              </div>
          </div>
        </div>
    </div>
</div>
</section>
@endsection
