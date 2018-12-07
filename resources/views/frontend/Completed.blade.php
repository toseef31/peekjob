@extends('frontend.layouts.app')
@section('title', 'Payment completed')
@section('content')
<section id="learn-section" class='paymentCompleted'>
    <div class="container">
        <div class="col-md-12 learn-search-box">
            <h2 class="text-center">Payment completed</h2>
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="ls-box">
                         <img src="{{asset('images/paymentCompleted.svg')}}" class='img-responsive centerAlign' style="width: 130px;"/>
                         <br>
                         <p style="color:white;text-align: center;">We verify your payment as soon as possible and publish product.</p>
                    </div>
                </div>
            </div>
            <div class="row">
            </div>
        </div>
    </div>
</section>