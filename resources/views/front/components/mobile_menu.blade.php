@section('mobile_menu')
<!--MENU DI ĐỘNG-->
<section>
    <div class="mm">
        <div class="mm-inn">
            <div class="mm-logo">
                <a href="{{ url('/') }}"><img src="{{ asset("front/images/logo.png") }}" alt="Logo Khách Sạn"></a>
            </div>
            <div class="mm-icon">
                <span><i class="fa fa-bars show-menu" aria-hidden="true"></i></span>
            </div>
            <div class="mm-menu">
                <div class="mm-close">
                    <span><i class="fa fa-times hide-menu" aria-hidden="true"></i></span>
                </div>
                <ul>
                    <li><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li><a href="{{ url('/room_type') }}">Phòng</a></li>
                    <li><a href="{{ url('/event') }}">Sự kiện</a></li>
                    <li><a href="{{ url('/food') }}">Thực đơn</a></li>
                    @if(\App\Model\Page::where('url_title', 'about')->where('status', true)->exists())
                        <li><a href="{{ url('/about') }}">Giới thiệu</a></li>
                    @endif
                    <li><a href="{{ url('/contact') }}">Liên hệ</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
@show