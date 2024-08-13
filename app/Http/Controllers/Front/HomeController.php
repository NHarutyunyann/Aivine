<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller{

    public function index(){
        // $data= 'aivinebeauty.com!@#';
        // dd(Hash::make($data));

        return view('front.home');
    }
   
    public function contacts(){
        return view('front.contact');
    }
    public function sendMessage(Request $request){
        $name = $request->name ;
        $email = $request->email;
        $msg = $request->msg;
        if($name && $email && $msg){
            Mail::to('Harutyunya.n@mail.ru')->send(new MyTestEmail($name, $email, $msg));
            return redirect()->back()->with('success', '+');   
        }else{
            return redirect()->back()->with('error message', '+');  
        }
    }
   
}
