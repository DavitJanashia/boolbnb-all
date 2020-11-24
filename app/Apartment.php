<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [

      'user_id',
      'description',
      'number_of_rooms',
      'number_of_beds',
      'number_of_bathrooms',
      'square_meters',
      'address',
      'city',
      'state',
      'lat',
      'lng',
      'sponsorship',
      'visibility'

    ];

    public function user() {
      return $this -> belongsTo(User::class);
    }

    public function payments() {
      return $this -> hasMany(Payment::class);
    }

    public function services() {
      return $this -> belongsToMany(Service::class);
    }

    public function messages() {
      return $this -> hasMany(Message::class);
    }

    public function statistic(){
      return $this -> hasMany(Statistic::class);
    }

    public function images(){
      return $this -> hasMany(Image::class);
    }
}
