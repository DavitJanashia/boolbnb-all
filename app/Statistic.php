<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
  protected $fillable = [

    'apartment_id',
    'current_date',
    'number_of_click'
    // 'number_of_messages'
  ];

  public $timestamps = false;

  public function apartment(){
    return $this->belongsTo(Apartment::class, 'apartment_id');
  }
}
