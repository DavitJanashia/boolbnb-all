@extends('layouts.main-layout')

@section('content')

<section id="sponsorship">
  <div class="container">

    <div class="row justify-content-center">
      <div class="mt-4 col-md-8">
        <div class="card">
          <div class="card-header">
            <h1 class="text-center">Sponsorizza il tuo appartamento</h1>
          </div>
          <div class="card-body">
            <form id="payment_form" action="{{ route('sponsor.check')}}" method="post">
              @csrf
              @method('POST')

              @if (session('sponsorshipError'))
                <div class="alert alert-danger">
                  <p>{{ session('sponsorshipError') }}</p>
                </div>
              @endif
              @if (session('apartmentError'))
                <div class="alert alert-danger">
                  <p>{{ session('apartmentError') }}</p>
                </div>
              @endif
              @if (session('sponsorError'))
                <div class="alert alert-danger">
                  <p>{{ session('sponsorError') }}</p>
                </div>
              @endif

              <h1 >Scegli la sponsorizzazione</h1>

              @foreach ($sponsorships as $sponsor)

                <div class="form-check mb-4">
                  <input class="form-check-input" type="radio" name="sponsors" id="sponsors" value="{{ $sponsor -> id}}">
                  <label class="form-check-label" for="sponsors">
                    {{ $sponsor -> type_of_sponsorship }} - {{ $sponsor -> price }}€ / {{ $sponsor -> deadline }}h
                  </label>
                </div>

              @endforeach

              <h1 >Scegli il tuo appartamento</h1>


              @foreach ($apartments as $apartment)

                <div class="form-check">
                  <input class="form-check-input" type="radio" name="apartments" id="apartments" value="{{ $apartment -> id}}">
                  <label class="form-check-label" for="apartments">
                    {{ $apartment -> description }}
                  </label>
                </div>

              @endforeach

              <div class="bt-drop-in-wrapper">
                <div id="bt-dropin"></div>
              </div>

              <input id="clientToken" type="hidden" value="{{ $clientToken }}">

              <input id="nonce" name="payment_method_nonce" type="hidden">

              <button class="btn btn-primary" type="submit">Acquista</button>

            </form>

          </div>

        </div>

      </div>

    </div>

  </div>
</section>

<script src="https://js.braintreegateway.com/web/dropin/1.25.0/js/dropin.min.js"></script>
<script src="{{ asset('js/sponsor.js') }}"></script>
@endsection
