<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Statistic;
use App\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Http\Response;


class ChartClickController extends Controller

{

  public function statistic( Request $request )
    {
         $data = $request['id'];
         $this->statisticJson( $request);

         return view('statistic', compact('data'));
    }

    public function statisticJson( Request $request )

    {

      $id = $request['id'];
      $statistic = Statistic::where('apartment_id',"=", $id)
        ->get();
        $this->messageStatisticJson($id);
      return response()->json($statistic);
    }


    public function messageStatisticJson($id){

      $message = Message::select('apartment_id','created_at')
                        ->where('apartment_id',"=", $id)
                        ->get()


                        ->groupBy(function($date) {
                          return Carbon::parse($date->created_at)->format('Y-m-d');
                      });


      return response()->json($message);

    }



}
