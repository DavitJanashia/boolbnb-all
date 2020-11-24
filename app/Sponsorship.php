<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
  protected $fillable = [

    'type_of_sponsorship',
    'price',
    'deadline'

  ];
  public $timestamps = false;
  
  public function payments() {
    return $this -> hasMany(Payment::class);
  }
}
