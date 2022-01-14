<?php

namespace App\Http\Controllers\FrontEnd;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        return view('frontEnd.contact.contactForm');
    }

    public function store(Request $request){
        Contact::create($request->all());

        // return success message in the contact page
        session()->flash('success',"Thank you for your message");
        return redirect(route('contact.index'));
    }

    public function getMessages(){
//        dd(Contact::all());
        $messages = Contact::all();
        return view('dashboard.contact.contactMessages',['messages' => $messages]);
    }

    public function showMessage($id){
        $message = Contact::find($id);
        return view('dashboard.contact.show',['message' => $message]);
    }

    public function deleteMessage($id){
        $message = Contact::find($id);
        $message->delete();
        session()->flash('error','The Message has been trashed successfully');
        return redirect(route('contactUs.messages'));
    }
}
