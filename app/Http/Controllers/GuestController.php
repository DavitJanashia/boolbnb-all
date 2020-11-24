<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Http\Response;

use App\Apartment;
use App\Service;
use App\Statistic;
use App\Tracker;

class GuestController extends Controller
{

  public function welcome(Request $request){

      $now = Carbon::now()->addHours(1);
      $expiredTime = $now->copy()->endOfDay();
      $delta= $expiredTime-> diffInMinutes($now);

      $user_ip = \Request::getClientIp();

    // dd($user_ip);

      if($request->hasCookie('thisUser') == false){
        Cookie::queue(Cookie::make('thisUser', json_encode([$user_ip, "ClickCookie"]), $delta));
      }
    // $minutes= 3;



    // $val = json_decode($request->cookie('thisUser'),true);

      $count=0;
      $aparts = Apartment::where('sponsorship', '=', true) -> get();

        return view('welcome',compact('aparts','count'));
  }

   // inizio nuova funzione -------------------------------------------------------------------------
    public function show(Request $request , $id) {

      $now = Carbon::now()->addHours(1);
      $expiredTime = $now->copy()->endOfDay();
      $delta= $expiredTime-> diffInMinutes($now);


      $apart = Apartment::findOrFail($id);
      $user_ip = \Request::getClientIp();

      $services = $apart->services()->get();
      $stat = $apart->statistic()->get();
      $user = Auth::user();

      $today = Carbon::now()->addHours(1)->isoFormat('Y M D');
      $count = count($stat);
      $i=0;

        $cookieVal = json_decode($request->cookie('thisUser'),true);

        if(is_null($cookieVal)){

            $user_ip = \Request::getClientIp();

            Cookie::queue(Cookie::make('thisUser', json_encode([$user_ip, rand(0,50)]), $delta));

          }
            if (!in_array($apart->id,$cookieVal) ) {

              array_push($cookieVal,$apart->id);
              Cookie::queue(Cookie::make('thisUser', json_encode($cookieVal), $delta));


                  if ( is_null($user) ) {
                    foreach ($stat as $statistic) {
                      $currentdate = Carbon::parse($statistic['current_date'])->isoFormat('Y M D');

                          if ($currentdate == $today ) {
                            $statistic ->increment('number_of_click');
                          }
                          else {
                            $i ++;
                          }
                      } //---------end foreach

                          if( $count == $i) {
                          $apart->statistic()->create();
                          }
                    } //---------end is_null

                  else if( $user['id'] !== $apart['user_id'] ) {
                    foreach ($stat as $statistic) {
                      $currentdate = Carbon::parse($statistic['current_date'])->isoFormat('Y M D');

                        if ($currentdate == $today ) {
                          $statistic ->increment('number_of_click');
                        }
                        else{
                          $i ++;
                        }
                    }  //---------end foreach

                            if( $count == $i) {
                              $apart->statistic()->create();
                            }
                  }  //---------end else-if

            } //---------end MAIN IF (!COOKIE)
              else{
            }

            // dd($request->cookie());

            $cook = $request-> cookie('thisUser');
            $newcookie = new Tracker;
            $newcookie-> cookie_name = $cook;
            $newcookie -> minuti_mancanti = $delta;
            $newcookie->save();

            // dd($currentdate,$today);

    return view('show-guest-apartment', compact('apart','services','user'));
  }

   // inizio nuova funzione -------------------------------------------------------------------------
  public function latlng(Request $request) {

    $lat = $request['lat'];
    $lng = $request['lng'];
    // dd($lat, $lng);

    return view('search-results', compact('lat','lng'));
  }
   // inizio nuova funzione --------------------------------------------------------------------------
    public function index() {

    $aparts = Apartment::all();

    foreach ($aparts as $apart) {
      $i = 1;
      $i++;
      $arrayImgs = [];
        $imgs = $apart -> images() -> get();
        // dd($imgs);
          if ($imgs !== null ) {

            // $arrayImgs = [];
            $i = 0;
              foreach ($imgs as $img) {
                $arrayImgs[$i] = $img['image_path'];
                $i++;
              }
            // $apart['imgs'] = $arrayImgs;
          }

          else {
            $arrayImgs[0] = ['no'];
          }
          $apart['imgs'] = $arrayImgs;


      $servs = $apart -> services() -> get();
      $arrayServ = [0];
      if ($servs !== null ) {

        // $arrayServ = [];
        $j = 1;
        foreach ($servs as $serv) {
          $arrayServ[$j] = $serv['id'];
          $j++;
        }


        $apart['services'] = $arrayServ;
      }
      else {
        // $apart['imgs'] = [1,2,3,4];
      }


    }



    return response()->json($aparts);
  }



}
