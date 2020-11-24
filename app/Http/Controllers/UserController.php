<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Apartment;
use App\Service;
use App\Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\UploadedFile;

use Illuminate\Http\File;
use Illuminate\Support\Collection;

use Illuminate\Support\Str;

class UserController extends Controller
{
  public function __construct() {

    $this->middleware('auth');
  }

  public function create() {



      return view('apartment-create');

    }
    public function store(Request $request) {

      $validator = Validator::make($request->all(), [
        'description'          => ['required','string','regex:/(^[A-Za-z0-9 ]+$)+/','min:3','max:150'],
        'number_of_rooms'      => ['required', 'integer', 'min:1'],
        'number_of_beds'       => ['required', 'integer', 'min:1'],
        'number_of_bathrooms'  => ['required', 'integer', 'min:1'],
        'square_meters'        => ['required', 'integer', 'min:25'],
        'address'              => ['required','string','regex:/(^[A-Za-z0-9 ]+$)+/','min:3','max:80'],
        // 'city'                 => ['required','string','regex:/(^[A-Za-z]+$)+/','min:3','max:60'],
        // 'state'                => ['required','string','regex:/(^[A-Za-z]+$)+/','min:3','max:60'],

        'image_path' =>                'required',
        'image_path.*' =>              'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
       ]);

        if ($validator->fails()) {
                return redirect('/create')
                       ->withErrors($validator)
                       ->withInput();
              }

      $user = Auth::user();
      $data = $request -> all();

      $apart = Apartment::create($data);

      $wifi = $request -> input('wifi');
      if ($wifi) {
      $apart -> services() -> attach(1);
      }

      $parking = $request -> input('parking');
      if ($parking) {
      $apart -> services() -> attach(2);
      }

      $sauna = $request -> input('sauna');
      if ($sauna) {
      $apart -> services() -> attach(3);
      }

      $sea_view = $request -> input('sea_view');
      if ($sea_view) {
      $apart -> services() -> attach(4);
      }

      $pool = $request -> input('pool');
      if ($pool) {
      $apart -> services() -> attach(5);
      }

      $reception = $request -> input('reception');
      if ($reception) {
      $apart -> services() -> attach(6);
      }

      if($request->hasfile('image_path')) {

        foreach ($request->file('image_path') as $image) {

          $apartmentImage = new Image;
      		$name = $image->getClientOriginalName();
      		$path = 'images/apartment/'.$apart->id.'/'.$name;
          $storepath = 'images/apartment/'.$apart->id .'/';
      		$image->move($storepath,$name);

      		$apartmentImage->apartment_id = $apart->id;
      		$apartmentImage->image_path = $path;
      		$apartmentImage->save();
          }
    }

      $us_id = $user -> id;
      $apart -> user_id = $us_id;
      $apart->save();



      return redirect()-> route('user.index');
    }

    public function usindex() {
      $user = Auth::user();

      $id = $user -> id;
      $aparts = Apartment::where('user_id',$id) -> get();
      $count=0;

      // dd($apartms);

      return view('user-apartments',compact('aparts','count'));
    }

    public function edit($id) {

      $apart = Apartment::findOrFail($id);
      $services = $apart->services()->get();
      $images = $apart->images()->get();

      return view('edit-apartment',compact('apart','services','images'));
    }

    public function update(Request $request, $id) {

      $validator = Validator::make($request->all(), [
        'description'          => ['string','regex:/(^[A-Za-z0-9 ]+$)+/','min:3','max:150'],
        'number_of_rooms'      => ['integer', 'min:1'],
        'number_of_beds'       => ['integer', 'min:1'],
        'number_of_bathrooms'  => ['integer', 'min:1'],
        'square_meters'        => ['integer', 'min:25'],
        'address'              => ['string','regex:/(^[A-Za-z0-9 ]+$)+/','min:3','max:80'],
        // 'city'                 => ['string','regex:/(^[A-Za-z]+$)+/','min:3','max:60'],
        // 'state'                => ['string','regex:/(^[A-Za-z]+$)+/','min:3','max:60'],

        // 'image_path' =>                'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image_path.*' =>              'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
       ]);

        if ($validator->fails()) {
                // return redirect('/create')
                return redirect('edit/'.$id)
                      ->withErrors($validator)
                       ->withInput();
              }

      $data = $request -> all();
      $apart = Apartment::findOrFail($id);
      $services = $apart->services()->detach();


      $wifi = $request -> input('wifi');
      if ($wifi) {
      $apart -> services() -> sync(1,false);
      }

      $parking = $request -> input('parking');
      if ($parking) {
      $apart -> services() -> sync(2,false);
      }

      $sauna = $request -> input('sauna');
      if ($sauna) {
      $apart -> services() -> sync(3,false);
      }

      $sea_view = $request -> input('sea_view');
      if ($sea_view) {
      $apart -> services() -> sync(4,false);
      }

      $pool = $request -> input('pool');
      if ($pool) {
      $apart -> services() -> sync(5,false);
      }

      $reception = $request -> input('reception');
      if ($reception) {
      $apart -> services() -> sync(6,false);
      }

      if($request->hasfile('image_path')) {

        foreach ($request->file('image_path') as $image) {

          $apart -> update($data);

       		$apartmentImage = new Image;
       		$name = $image->getClientOriginalName();
       		$path = 'images/apartment/'.$apart->id.'/'.$name;
           $storepath = 'images/apartment/'.$apart->id .'/';
       		$image->move($storepath,$name);

       		$apartmentImage->apartment_id = $apart->id;
       		$apartmentImage->image_path = $path;
       		$apartmentImage->save();
       	  }
        } else{

          $apart -> update($data);
        }

         $apart->save();


      return redirect() -> route('user.index');
    }

    public function delete($id) {

      $apart = Apartment::findOrFail($id);
      $apart -> delete();

      return redirect() -> route('user.index');
    }

    public function show($id) {

      $apart = Apartment::findOrFail($id);
      $services = $apart->services()->get();
      $count=0;

      return view('show-apartment', compact('apart','services','count'));
    }

    public function destroyImage($id) {
        $image = Image::findOrFail($id);
        $apart_id= $image -> apartment_id;
        $storedimages= $image -> image_path;
        unlink($storedimages);

        $image->delete();

        return redirect()-> back();
    }

    public function messageList($id) {

      $apart = Apartment::findOrFail($id);
      $messages = $apart -> messages() -> get();

      return view('apart-messages',compact('messages'));
    }

    public function apartHide($id) {

      $apart = Apartment::findOrFail($id);

        $apart['visibility'] = false;
        $apart -> save();
      $services = $apart->services()->get();
      $count=0;

      return view('show-apartment',compact('apart','services','count'));

    }

    public function apartVisible($id) {

      $apart = Apartment::findOrFail($id);

        $apart['visibility'] = true;
        $apart -> save();
      $services = $apart->services()->get();
      $count=0;

      return view('show-apartment',compact('apart','services','count'));

    }
}
