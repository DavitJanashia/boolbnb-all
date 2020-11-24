<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  protected $fillable =  [

    'apartment_id',
    'sponsorship_id',
    'ref_payment',
    'start_of_sponsorship',
    'date_of_payment',
    'no_of_card',
    'cvc',
    'deadline'
    
  ];

  public function sponsorship() {
    return $this -> belongsTo(Sponsorship::class);
  }

  public function apartment() {
    return $this -> belongsTo(Apartment::class);
  }
}
