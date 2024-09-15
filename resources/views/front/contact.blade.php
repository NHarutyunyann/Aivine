@extends('layouts.front')
@section('title')aivinebeauty aivine aivinebeauty @endsection
@section('description') @endsection
@section('keywords')Aivine beauty & esthetics,aivine beauty, asexain, epilacia, aivine contact, aivine asexayin mazaheracum, patvirel, aivinebeauty contact, aivinebeauty com, @endsection
@section('url')
    {{ url('/contacts') }}
@endsection
@section('style') @endsection
@section('content')
<div class='contact'>
    <div class='contact_first'>
        <img class="contact_first_img" src="/images/aivine/contactimage.webp" alt="images">
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
                @if(session('success') || session('error message'))
                    <div class="modal fade show" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" style="display: block;">
                        <div class="bigDiv ">
                            <div class="modalsend show">
                                <p class='modalText modalTextError'>@if(session('error message'))@lang('main.error message') @endif</p>
                                <p class='modalText modalTExtSuccess'>@if(session('success'))@lang('main.success message') @endif</p>
                                <button id="moodalClose" type="button" class="btn send_btn">
                                    <a @if(session('success')) href="/" @endif>
                                        <p class="modalButtonText">@lang('main.close')</p>
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>



@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#moodalClose').click(function() {
            // $('#successModal').modal('hide');
            $(".show").remove();
            $("#successModal").hide();
        });
    })
// </script>
@endsection
