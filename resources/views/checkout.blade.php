@extends('layouts.main-layout')

@section('content')
<section id="sponsorship">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Riepilogo operazione</div>

                  <div class="card-body">

                    <h1>Transazione avvenuta con successo</h1>
                    <p>Appartamento selezionato: {{ $apartment -> description }}</p>
                    <p>Tipologia di sponsorizzazione: {{ $sponsorship -> type_of_sponsorship }} - {{ $sponsorship  -> price }}€ / {{ $sponsorship  -> deadline }}h</p>
                    <p>Il numero transazione è: {{ $transaction_id }}</p>

                    <a class="btn btn-primary" href="{{route('user.index')}}">I tuoi annunci</a>

                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection
