@extends('layouts.front')
@section('title')Aivine Contacts @endsection
@section('description') @endsection
@section('keywords') @endsection
@section('url')
    {{ url('/contacts') }}
@endsection
@section('style') @endsection
@section('content')
<div class='contact'>
    <div class='contact_first'>
        <img class="contact_first_img" src="/images/aivine/contactimage.svg" alt="images">
        <p class="contact_first_text">Fill in your information</p>
    </div>
    <div class="contanier">
        <div class="send_message">
            <div class="send_message_info">
                <p class="send_message_title">Fill in your information, and we will contact you.</p>
            </div>
            <form action="/send_message" method="POST">
                @csrf
                <div class="send_message_inputs">
                    <div class="name_phone">
                        <input name="name" type="text" placeholder="Full Name *">
                        <input name="phone_number" type="text" placeholder="Phone Number *">
                    </div>
                    <div class="message">
                        <input name="address" type="text" placeholder="Country/ City/ Address *">
                        <textarea name="message" placeholder="Message" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="send_message_btn">
                    <button>Order</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
@section('script')

@endsection
