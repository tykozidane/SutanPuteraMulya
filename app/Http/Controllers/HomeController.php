<?php

namespace App\Http\Controllers;

use Faker\Guesser\Name;
use Illuminate\Http\Request;
use Mail;

class HomeController extends Controller
{
    public function index()
    {
        return view('v_welcome');
    }
    public function emailAction(Request $request)
    {    
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required',
            'name' => 'required',
            'content' => 'required',
          ]);
  
          $data = [
            'subject' => $request->subject,
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content
          ];
  
          Mail::send('email-template', $data, function($message) use ($data) {
            $message->to('sutanputeramulya@gmail.com',$data['name'])
            ->subject($data['subject']);
          });
  
          return back()->with(['message' => 'Email successfully sent!']);
      }
            
    
}

