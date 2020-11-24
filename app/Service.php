<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
  public $timestamps = false;

  protected $fillable = [

    'service'
    
  ];

  public function apartments() {
    return $this -> belongsToMany(Apartment::class);
  }
}
