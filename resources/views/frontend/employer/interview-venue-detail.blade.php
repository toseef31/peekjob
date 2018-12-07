@extends('frontend.layouts.app')

@section('title',"$venue->title")

@section('content')
<section id="postNewJob">
    <div class="container">
        <div class="col-md-12 cVenue-box">
            <h3>{!! $venue->title !!}  <a href="{{ url('account/employer/interview-venues') }}" class="pull-right" style="font-size: 12px"><i class="fa fa-arrow-left"></i> @lang('home.goback')</a></h3>

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="active">@lang('home.contactperson')</td>
                        <td>{!! $venue->contact !!}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.phone')</td>
                        <td>{!! $venue->phone !!}</td>
                    </tr>
					
                    <tr>
                        <td class="active">@lang('home.mobile')</td>
                        <td>{!! $venue->mobile !!}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.email')</td>
                        <td>{!! $venue->email !!}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.address')</td>
                        <td>{!! $venue->address !!} </td>
                    </tr>
                </tbody>
            </table>
            <div class="venue-map">
                <div id="map" style="width:100%;height:400px;"></div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('page-footer')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXJg9a2_Rt1iSQqZvAICx0cVykFoQYq_0&callback=initMap"></script>
<script type="text/javascript">
function initMap() {
    var uluru = {lat: {{ $latLng->lat }}, lng: {{ $latLng->lng }}};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: uluru
    });
    var marker = new google.maps.Marker({
        position: uluru,
        map: map
    });
}
</script>
@endsection