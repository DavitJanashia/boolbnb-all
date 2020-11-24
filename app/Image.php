<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  protected $fillable = [
                        'apartment_id',
                        'image_path'
                        ];

    public $timestamps = false;

    public function apartment(){
      return $this -> belongsTo(Apartment::class , 'apartment_id');
  }

}
