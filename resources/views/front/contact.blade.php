@extends('layouts.front')

@section('content')

    <div class="inn-banner">
        <div class="container">
            <div class="row">
                <h4>Liên hệ</h4>
                <p>Liên hệ với chúng tôi qua bất kỳ phương thức nào bên dưới.</p>
                <p> </p>
                <ul>
                    <li><a href="#">Trang chủ</a></li>
                    <li><a href="#">Liên hệ</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="inn-body-section">
        <div class="container">
            <div class="row">
                <div class="page-head">
                    <h2>Liên hệ</h2>
                    <div class="head-title">
                        <div class="hl-1"></div>
                        <div class="hl-2"></div>
                        <div class="hl-3"></div>
                    </div>
                    <p>Liên hệ với chúng tôi nếu bạn có bất kỳ thắc mắc hoặc cần hỗ trợ về khách sạn và hệ thống.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12 new-con">
                    <h2>{{ config('app.name') }} <span>Đặt phòng</span></h2>
                    <p>Ứng dụng web này cung cấp thông tin, đánh giá và hình ảnh về khách sạn của chúng tôi. Đặt phòng khách sạn với giá ưu đãi.</p>
                    <p>Dịch vụ đặt phòng khách sạn được đánh giá cao nhất.</p>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12 new-con">
                    <img src="{{ asset("front/images/icon/20.png") }}" alt="">
                    <h4>Địa chỉ</h4>
                    <p>{{ config('app.address') }}</p>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12 new-con">
                    <img src="{{ asset("front/images/icon/22.png") }}" alt="">
                    <h4>Thông tin liên hệ</h4>
                    <p>
                        <a href="tel://0099999999" class="contact-icon">Điện thoại: {{ config('app.phone_number') }}</a><br>
                        <a href="mailto:mytestmail@gmail.com" class="contact-icon">Email: {{ config('app.email') }}</a>
                    </p>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12 new-con">
                    <img src="{{ asset("front/images/icon/21.png") }}" alt="">
                    <h4>Website</h4>
                    <p>
                        <a href="{{ config('app.website') }}">Trang web: {{ config('app.website') }}</a><br>
                        <a href="{{ config('app.facebook') }}">Facebook: {{ config('app.facebook') }}</a><br>
                        <a href="{{ config('app.twitter') }}">Twitter: {{ config('app.twitter') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="contact-map">
            <iframe src="http://maps.google.com/maps?z=16&t=m&q=loc:{{ config('app.latitude') }}+{{ config('app.longitude') }}&amp;output=embed" allowfullscreen></iframe>
        </div>
    </div>
@endsection