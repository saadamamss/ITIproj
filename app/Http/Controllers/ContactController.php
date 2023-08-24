<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {

        return view('pages.contact');
    }

    public function send(Request $request)
    {


        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|regex:/^\+201[0125][0-9]{8}$/',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);


        $contcat = new Contact();
        $contcat->name = $request->name;
        $contcat->email = $request->email;
        $contcat->phone = $request->phone;
        $contcat->subject = $request->subject;
        $contcat->message = $request->message;

        $contcat->save();

        session()->put('contact', 'message sent successfully');
        return redirect()->route('contact');
    }
}
