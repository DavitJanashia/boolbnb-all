<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Braintree
use Braintree;

// Time
use Carbon\Carbon;

// MyModel
use App\Sponsorship;
use App\Payment;
use App\Apartment;
use App\User;


class SponsorshipController extends Controller
{

  public function __construct() {

    $this->middleware('auth');
  }

  // Braintree

  private static function isTransactionSuccessful($status) {
    return in_array($status, [
      Transaction::AUTHORIZED,
      Transaction::AUTHORIZING,
      Transaction::SETTLED,
      Transaction::SETTLING,
      Transaction::SETTLEMENT_CONFIRMED,
      Transaction::SETTLEMENT_PENDING,
      Transaction::SUBMITTED_FOR_SETTLEMENT
    ]);
  }


  public function choose() {

    $sponsorships = Sponsorship::all();
    $apartments = Apartment::where('user_id', '=', Auth::id()) -> get();
    $clientToken = $this -> gateway() -> clientToken() -> generate();
    return view('sponsorship', compact('sponsorships', 'apartments', 'clientToken'));
  }


  public function checkout(Request $request) {

    $data = $request -> all();

    $sponsorshipError = 'Seleziona una sponsorizzazione';
    if(empty($data['sponsors'])) {
      return redirect()->back()->with('sponsorshipError', $sponsorshipError);
    }

    $apartmentError = 'Seleziona un appartamento';
    if(empty($data['apartments'])) {
      return redirect()->back()->with('apartmentError', $apartmentError);
    }

    $sponsorship = Sponsorship::findOrFail($request -> sponsors);
    $amount = $sponsorship -> price;

    $apartment = Apartment::findOrFail($request -> apartments);

    $result = $this->gateway()->transaction()->sale([
      'amount' => $amount,
      'paymentMethodNonce' => $data['payment_method_nonce'],
      'options' => [
          'submitForSettlement' => true
      ]
    ]);

    if ($result -> success && $apartment -> sponsorship == false) {

      $transaction = $result -> transaction;
      $transaction_id = $transaction -> id;

      $apartment_id = $apartment -> id;

      $sponsorship_id = $sponsorship -> id;

      $startSponsor = Carbon::now();
      $deadSponsor = Carbon::now() -> addHours($sponsorship -> deadline);

      $SponsorApartment = $apartment -> update(['sponsorship' => true]);

      $pay = Payment::create([
                              'apartment_id' => $apartment_id,
                              'sponsorship_id' => $sponsorship_id,
                              'start_of_sponsorship' => $startSponsor,
                              'deadline' => $deadSponsor
                            ]);


      return view('checkout', compact('transaction_id', 'sponsorship', 'apartment'));

    } else {

      $sponsorError = 'Appartamento già sponsorizzato';

      return redirect()->back()->with('sponsorError', $sponsorError);

    }
  }

  private function gateway(){
    $gateway = new Braintree\Gateway([
      'environment' => getenv('BT_ENVIRONMENT'),
      'merchantId' => getenv('BT_MERCHANT_ID'),
      'publicKey' => getenv('BT_PUBLIC_KEY'),
      'privateKey' => getenv('BT_PRIVATE_KEY')
      ]);
    return $gateway;
  }

}
