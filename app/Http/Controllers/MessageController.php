<?php

namespace App\Http\Controllers;
use App\Apartment;
use App\Message;
use App\User;
use App\Mail\MessageSend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
  public function create (Request $request) {

    $data = $request -> all();
    $message = Message::create($data);
    $id = $message['apartment_id'];
    $msg_id = $message['id'];
    // dd($id);
    $user = Auth::user();
    $action = 'Hai ricevuto un messaggio per il tuo appartamento';




    $data['apartment_id'] = $id;
    $apart = Apartment::findOrFail($id);
    $prop_id = $apart['user_id'];
    $services = $apart -> services() -> get();
    // dd($message);
    $proprietario = User::findOrFail($prop_id);
    $msg = Message::findOrFail($msg_id);
    // dd($message['email']);
    Mail::to($proprietario['email'])
          ->send(new MessageSend($msg,$apart,$action));
    // dd($apart);
    return view('show-guest-apartment',compact('apart','services','user'));
  }
}
