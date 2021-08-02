@extends('layouts.theme')
@section('title','Purchase Plan')
@section('main-wrapper')
<style>
div {
  display: block;
  position: relative;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}


.ribbon {
  width: 150px;
  height: 150px;
  overflow: hidden;
  position: absolute;
}

.ribbon::before,
.ribbon::after {
  position: absolute;
  z-index: -1;
  content: '';
  display: block;
  border: 5px solid green;
}

.ribbon span {
  position: absolute;
  display: block;
  width: 225px;
  padding: 7px 0;
  background-color: green;
  box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
  color: #fff;
  font: 0 18px/1 'Lato', sans-serif;
  text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
  text-transform: uppercase;
  text-align: center;
}

.ribbon-top-right {
  top: -10px;
  right: -10px
}

.ribbon-top-right::before,
.ribbon-top-right::after {
  border-top-color: transparent;
  border-right-color: transparent
}

.ribbon-top-right::before {
  top: 0;
  left: 17px
}

.ribbon-top-right::after {
  bottom: 17px;
  right: 0
}

.ribbon-top-right span {
  left: -25px;
  top: 30px;
  transform: rotate(45deg)
}

.container {
  margin-top: 100px;
  margin-bottom: 100px
}

.bbb_deals_featured {
  width: 100%
}

.bbb_deals {
  width: 36%;
  margin-right: 7%;
  padding-top: 85px;
  padding-left: 2px;
  padding-right: 2px;
  padding-bottom: 35px;
  box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
  border-radius: 0px;
  border-top: black 3px solid;
}

.image2 {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 60px;
}

.bbb_deals:hover .image2 {
  width: 65px;
  opacity: 1;
}

.bbb_deals_title {
  position: absolute;
  top: 27px;
  left: 100px;
  font-size: 18px;
  font-weight: 700;
  color: #000000
}

.bbb_deals_slider_container {
  width: 100%
}

.bbb_deals_item {
  width: 100% !important
}

.bbb_deals_image {
  width: 100%
}

.bbb_deals_image img {
  width: 100%
}

.image1 {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 80%;
}

.bbb_deals:hover .image1 {
  width: 82%;
  opacity: 1;
}

.bbb_deals_content {
  margin-top: 33px
}

.bbb_deals_item_category a {
  font-size: 14px;
  font-weight: 400;
  color: rgba(0, 0, 0, 0.5)
}

.bbb_deals_item_price_a {
  font-size: 14px;
  font-weight: 400;
  color: rgba(0, 0, 0, 0.6)
}

.bbb_deals_item_name {
  font-size: 24px;
  font-weight: 400;
  color: #000000;
  left: 45px;
}

.bbb_deals_item_price {
  font-size: 24px;
  font-weight: 500;
  color: #df3b3b
}

.available {
  margin-top: 19px
}

.available_title {
  font-size: 12px;
  color: rgba(0, 0, 0, 0.5);
  font-weight: 400
}

.available_title span {
  font-weight: 700
}

.sold_title {
  font-size: 12px;
  color: rgba(0, 0, 0, 0.5);
  font-weight: 400
}

.sold_title span {
  font-weight: 700
}

@media only screen and (max-width: 1199px) {
  .bbb_deals_timer_box {
      width: 150px
  }

  .bbb_deals_timer_unit {
      font-size: 20px
  }
}

@media only screen and (max-width: 991px) {
  .bbb_deals {
      width: 100%;
      margin-right: 0px
  }
}

@media only screen and (max-width: 575px) {
  .bbb_deals {
      padding-left: 15px;
      padding-right: 15px
  }

  .bbb_deals_title {
      left: 15px;
      font-size: 16px
  }

  .bbb_deals_slider_nav_container {
      right: 5px
  }

  .bbb_deals_item_name,
  .bbb_deals_item_price {
      font-size: 20px
  }

  .bbb_deals_item_category a,
  .bbb_deals_item_price_a {
      font-size: 12px
  }

  .bbb_deals_timer_unit {
      font-size: 16px
  }
}
</style>


<div class="bbb_deals_featured">
    <div class="container">
        <div class="row">
            @foreach($plans as $plan)
                @if($plan->id%2 != 0)
                    <div class="col-md-6 col d-flex flex-lg-row flex-column align-items-center justify-content-center">
                        <div class="bbb_deals" style="background-color: rgba(219,205,240,255); padding-top: 30px; width: 270px; height: 530px;">
                            @if($plan->interval == 'year')
                                <div style="font-size: small;" class="ribbon ribbon-top-right"><span>Recommended</span></div>
                            @endif
                            <p style="font-size: large; text-align: center; font-weight: 700;">{{ $plan->name }}</p>
                            <div class="bbb_deals_slider_container">
                                <div class=" bbb_deals_item">
                                    <div class="bbb_deals_image image1"><img src="{{ url('images/new_package_design/1.png') }}" alt=""></div>
                                    <div class="bbb_deals_content">
                                        <p style="font-size: large; text-align: center; font-weight: 400;"><b>$</b> {{ $plan->amount }} / {{ $plan->interval }} </p>
                                        <p style="font-size: small; text-align: center;">
                                            <b>
                                                {{ $plan->title1 }}<br>
                                                {{ $plan->title2 }}<br>
                                                {{ $plan->title3 }}<br>
                                                {{ $plan->title4 }}<br>
                                                {{ $plan->title5 }}<br>
                                                {{ $plan->title6 }}
                                            </b>
                                        </p>
                                        @auth
                                            <a href="{{route('get_payment', $plan->id)}}"><img class="image2" src="{{ url('images/new_package_design/yes.png') }}" alt="Subscribe"></a>
                                        @else
                                            <a href="{{route('register')}}"><img class="image2" src="{{ url('images/new_package_design/yes.png') }}" alt="Register"></a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                @else
                    
                    <div class="col-md-6 col d-flex flex-lg-row flex-column align-items-center justify-content-center">
                        <div class="bbb_deals" style="background-color: rgb(53, 53, 53); padding-top: 30px; width: 270px; height: 530px;">
                            @if($plan->interval == 'year')
                                <div style="font-size: small;" class="ribbon ribbon-top-right"><span>Recommended</span></div>
                            @endif
                            <p style="font-size: large; text-align: center; font-weight: 700; color: white;">{{ $plan->name }}</p>
                            <div class="bbb_deals_slider_container">
                                <div class=" bbb_deals_item">
                                    <div class="bbb_deals_image image1"><img src="{{ url('images/new_package_design/2.png') }}" alt=""></div>
                                    <div class="bbb_deals_content">
                                        <p class="onhover" style="font-size: large; text-align: center; font-weight: 400; color: white;"><b>$</b>{{ $plan->amount }} / {{ $plan->interval }}</p>
                                        <p style="font-size: small; text-align: center; color: white;">
                                            <b>
                                                {{ $plan->title1 }}<br>
                                                {{ $plan->title2 }}<br>
                                                {{ $plan->title3 }}<br>
                                                {{ $plan->title4 }}<br>
                                                {{ $plan->title5 }}<br>
                                                {{ $plan->title6 }}
                                            </b>
                                        </p>
                                        @auth
                                            <a href="{{route('get_payment', $plan->id)}}"><img class="image2" src="{{ url('images/new_package_design/abutton.png') }}" alt="Subscribe"></a>
                                        @else
                                            <a href="{{route('register')}}"><img class="image2" src="{{ url('images/new_package_design/mbutton.png') }}" alt="Register"></a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            
        </div>
    </div>
</div>

@endsection