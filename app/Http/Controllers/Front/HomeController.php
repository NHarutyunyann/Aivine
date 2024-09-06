<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Mail\ContactForm;
use App\Models\Detail;
use App\Models\Product;
use App\Models\Question;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller{

    public function index(){
        $detels = Detail::active()->get();
        $product = Product::active()->with('attachments')->first();
        $questions = Question::active()->get();
        return view('front.home', ['detels' => $detels, 'product' => $product, 'questions' => $questions]);
    }
   
    public function contacts(){
        return view('front.contact');
    }
    
    public function sendMessage(Request $request){
        $name = $request->name ;
        $phone_number = $request->phone_number;
        $address = $request->address;
        $msg = $request->message;
        if($name && $phone_number && $address && $msg){
            Mail::to(['Harutyunya.n@mail.ru','allaavetyan70@gmail.com'])->send(new ContactForm(['name'=> $name, 'phone_number' => $phone_number, 'address' => $address, 'message' => $msg]));
            return redirect()->back()->with('success', '+');   
        }else{
            return redirect()->back()->with('error message', '+');  
        }
    }
   
}
