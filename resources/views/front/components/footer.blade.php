@section('footer')
    <footer class="site-footer clearfix">
        <div class="sidebar-container">
            <div class="sidebar-inner">
                <div class="widget-area clearfix">
                    <div class="widget widget_azh_widget">
                        <div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3 foot-logo">
                                        <h4>Celestial Plaza</h4>
                                        <p class="hasimg">Khách sạn Celestial Plaza cung cấp dịch vụ đặt phòng giá rẻ.</p>
                                        <p class="hasimg">Dịch vụ đặt phòng khách sạn được đánh giá cao nhất.</p>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <h4>Hỗ trợ &amp; Trợ giúp</h4>
                                        <ul class="two-columns">
                                            <li><a href="{{ '/room_type' }}">Phòng</a></li>
                                            <li><a href="{{ '/event' }}">Sự kiện</a></li>
                                            <li><a href="{{ url('/food') }}">Thực đơn</a></li>
                                            <li><a href="{{ url('/contact') }}">Liên hệ</a></li>
                                            <li><a href="{{ url('/about') }}">Giới thiệu</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <h4>Loại phòng</h4>
                                        <ul class="two-columns">
                                            @foreach(\App\Model\RoomType::where('status', true)->orderBy('updated_at','desc')->limit('8')->get() as $room_type)
                                            <li><a href="{{ url('/room_type/'.$room_type->id) }}">{{ $room_type->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <h4>Địa chỉ</h4>
                                        <p>{{ config('app.address', "Kathmandu") }}</p>
                                        <p><span class="foot-phone">Điện thoại: </span><span class="foot-phone">{{ config('app.phone_number', '09123456789') }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="foot-sec2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3">
                                        <h4>Phương thức thanh toán</h4>
                                        <p class="hasimg"><img src="{{ asset("front/images/payment.png") }}" alt="payment"></p>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <h4>Đăng ký nhận tin</h4>
                                        {!! Form::open(array('url' => '/subscribe')) !!}
                                        {{ Form::hidden('_method', 'POST') }}
                                        @csrf
                                        <ul class="foot-subsc">
                                            <li>
                                                <input name="email" type="email" placeholder="Nhập địa chỉ email của bạn">
                                            </li>
                                            <li>
                                                <input type="submit" value="Gửi">
                                            </li>
                                        </ul>
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="col-sm-12 col-md-5 foot-social">
                                        <h4>Kết nối với chúng tôi</h4>
                                        <p>Tham gia cùng hàng ngàn người dùng khác.</p>
                                        <ul>
                                            <li><a href="{{ config('app.facebook') }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                            <li><a href="{{ config('app.google') }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                            <li><a href="{{ config('app.twitter') }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                            <li><a href="{{ config('app.instagram') }}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .widget-area -->
            </div>
            <!-- .sidebar-inner -->
        </div>
        <!-- #quaternary -->
    </footer>
    <section class="copy" style="background-color: black;">
        <div class="container">
            <p>Bản quyền © 2022 {{ config('app.name', "Hệ thống đặt phòng khách sạn trực tuyến") }}. &nbsp;&nbsp;Đã đăng ký bản quyền.</p>
        </div>
    </section>
@show