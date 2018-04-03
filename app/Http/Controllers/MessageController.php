<?php

//Nermin
namespace App\Http\Controllers;
/*namespace App\Http\Controllers\Message;
use App\Http\Controllers\Controller;*/

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Message;

use Mail;
use Session;

class MessageController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['only' => 'deleteMessage']);
    }


    #send feedback to admins
    public function feedback(Request $req)
    {
        $this->validate($req,['name'=>'required|regex:/^[\pL\s\-]+$/u','email' => 'required|email', 'message' => 'required']);
        $messages = new Message(['sender_name' => $req->name, 'sender_email' => $req->email, 'message' => $req->message]);
        $messages->save();
        Session::flash('message', 'Message sent successfully');
        return \Redirect::to('/contactus');
    }




    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /// admin functionalities

    public function index()
    {
        $messages = Message::all();
        return view('administrator.messages',compact('messages'));
    }
    public function deleteMessage($message_id)
    {
        $messages = Message::find($message_id );
        if ($messages != null){
            $messages->forceDelete();
            return \Redirect::to('/admin/messages')->with('message', 'Message Deleted Successfully');
        }
        else{
            return redirect()->back();
        }
    }

    public function send(Request $req, Message $m)
    {
        $this->validate($req,[
            'Reply'=>'required']);

        Mail::raw($req['Reply'], function($message) use($m)
        {
            $message->from('mayshaing@gmail.com', 'Training-Center');
            $message->to($m->sender_email);
            $message->subject('In Reply to your message');
        });

        $m->replied = '1';
        $m->save();
        Session::flash('message', 'Reply sent successfully');
        return back();

    }
}
