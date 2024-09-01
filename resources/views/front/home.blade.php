@extends('layouts.front')
@section('title')
    Aivine
@endsection
@section('description')
@endsection
@section('keywords')
@endsection
@section('url')
    {{ url('/') }}
@endsection
@section('style')
@endsection

@section('content')
    <div class="home">
        <div class='contact_first'>
            <img class="contact_first_img" src="/images/aivine/homefirstimg.svg" alt="images">
                <div class="contact_first_text">
                    <p class="">Thermolysis - Galvanic Blend Electrolysis Permanent, painless Hair Removal System</p>
                        <a class="home_first_btn" href="/contacts">
                            <button class="home_first_btn">ORDER</button>
                        </a>
                </div> 
            <div class="home_first_2_totall">
                    <div class="home_first_2">
                    <img class="contact_first2_img" src="/images/aivine/first2.png" alt="images">
                    <div class="home_first_2_info">
                        <p class="home_first_2_info_text">We offer a perfect needle hair removal systems that will produce 100%
                            results and help you grow the number of customers. Outstanding for a professional salon and Medispa
                            setting.
                        </p>
                        <div class="home_first_2_info_text_name">-<p class="home_first_2_info_text_Aivine">AIVINE Beauty & ESTHETICS</p>-</div>
                    </div>
                </div>
            </div>
        </div>
      

        <div class="home_second">
            <div class="home_second_title">
                <h2>AIVINE SYSTEM INCLUDES</h2>
            </div>
            <div class="home_second_boxes">
                @foreach($detels as $detel)
                    <div class="home_second_box">
                        <div class="home_second_image">
                            <img src="{{ asset('storage/media/' . $detel->mainImage->path . '.' . $detel->mainImage->format) }}" alt="images">
                        </div>
                        <div class="home_second_info">
                            <h4 class="home_second_info_title">{{ $detel->title }}</h4>
                            <p class="home_second_info_text">{{ $detel->content }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="home_third">
            <div class="home_third_title">
                <h2>General view of the AIVINE equipment</h2>
                <p>PRICE {{ $product->price }}$</p>
            </div>
            <div class="home_third_image">
                <img src="{{ asset('storage/media/' . $product->mainImage->path . '.' . $product->mainImage->format) }}" alt="images">
            </div>
        </div>


        <div class="home_fourth">
            <div class="home_fourth_title">
                <h2>We care not only about hair removal, but also your safety, comfort, and beauty.</h2>
            </div>
            <div class="home_fourth_boxes">
                @foreach($questions as $question)
                    <div class="home_fourt_box">
                        <div class="home_fourt_box_img">
                            <img src="{{ asset('storage/media/' . $question->mainImage->path . '.' . $question->mainImage->format) }}" alt="images">
                        </div>
                        <div class="home_fourt_box_info">
                            <div class="home_fourt_box_info_text">
                                <h3>{{ $question->title }}</h3>
                                <p>{{ $question->content}}</p>
                            </div>
                            <div class="home_fourt_box_aivine">
                                <p>- AIVINE Beauty & ESTHETICS -</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>



        <div class="home_sixth">
            <img src="/images/aivine/sixth.png" alt="images">
        </div>

        <div class="home_seventh">
            <div class="home_seventh_title">
                <p>By purchasing our equipment, you will become a market-leading professional.</p>
            </div>
            <div class="home_seventh_images">
                @foreach($product->attachments as $attachment)
                    <img src="{{ asset('storage/media/' . $attachment->path . '.' . $attachment->format) }}" alt="images">
                @endforeach
            </div>
        </div>

        <div class="home_eighth">
            <div class="home_eighth_title">
                <p>With Aivine, you provide the maximum for your clients.</p>
            </div>
            <div class="home_eighth_info">
                <div class="home_eighth_boxe">
                    <img src="/images/aivine/eighth1.png" alt="images">
                    <p>Excellent outcome</p>
                </div>
                <div class="home_eighth_boxe">
                    <img src="/images/aivine/eighth2.png" alt="images">
                    <p>Painless procedure</p>
                </div>
                <div class="home_eighth_boxe">
                    <img src="/images/aivine/eighth3.png" alt="images">
                    <p>Permanent results</p>
                </div>
            </div>
        </div>



        <div class="home_ninth">
            <div class="home_ninth_image">
                <img src="/images/aivine/ninth1.svg" alt="image">
                <div class="home_ninth_order_box">
                    <p>We also teach you how to use it for free, both online and offline, in case you purchase.</p>
                    <a href="/contacts">ORDER</a>
                </div>
            </div>
        </div>


        <div class="home_tenth">
            <div class="home_tenth_title">
                <p>The steps required to complete the order.</p>
            </div>
            <div class="home_tenth_info">
                <div class="home_tenth_info_box">
                    <h3>01</h3>
                    <p>Fill in your information.</p>
                </div>
                <div class="home_tenth_info_box">
                    <h3>02</h3>
                    <p>Please wait for our call.</p>
                </div>
                <div class="home_tenth_info_box">
                    <h3>03</h3>
                    <p>Within a few days, you will obtain your Aivine.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
