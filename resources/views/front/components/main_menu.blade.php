@section('main_menu')
    <!--TOP SECTION-->
    <div class="row" style="background-color: #f7d678; align-items: center; display: flex; padding: 0.5rem 0; margin-left: 0; justify-content: flex-start; gap: 30px;">
        <div class="logo" style="flex: 0 0 auto; display: flex; align-items: center; justify-content: flex-start;">
            <a href="{{ url('/') }}" style="display: flex; align-items: center; text-decoration: none;">
                <img src="{{ asset('images/logoweb.png') }}" alt="Hotel Logo" style="height:72px; width:auto; margin-right:16px;">
                <span style="color: #222; font-size: 28px; font-weight: bold; letter-spacing: 1px; text-shadow: 1px 1px 2px #e6c15a;">Celestial Plaza Hotel</span>
            </a>
        </div>
        <div class="menu-bar" style="flex: 0 0 auto; display: flex; justify-content: flex-start;">
            <ul style="display: flex; align-items: center; margin: 0; list-style: none; flex-wrap: nowrap; gap: 14px;">
                <li style="white-space: nowrap;"><a href="{{ url('/') }}" style="color: #222; font-weight: 500; font-size: 15px; transition: color 0.2s; white-space: nowrap;">Trang chủ</a></li>
                <li style="white-space: nowrap;"><a href="{{ url('/room_type') }}" style="color: #222; font-weight: 500; font-size: 15px; transition: color 0.2s; white-space: nowrap;">Phòng</a></li>
                <li style="white-space: nowrap;"><a href="{{ url('/event') }}" style="color: #222; font-weight: 500; font-size: 15px; transition: color 0.2s; white-space: nowrap;">Sự kiện</a></li>
                <li style="white-space: nowrap;"><a href="{{ url('/food') }}" style="color: #222; font-weight: 500; font-size: 15px; transition: color 0.2s; white-space: nowrap;">Thực đơn</a></li>
                @if(count(\App\Model\Page::where('title', 'About')->where('status', true)->get()) > 0)
                <li style="white-space: nowrap;"><a href="{{ url('/about') }}" style="color: #222; font-weight: 500; font-size: 15px; transition: color 0.2s; white-space: nowrap;">Giới thiệu</a></li>
                @endif
                <li style="white-space: nowrap;"><a href="{{ url('/contact') }}" style="color: #222; font-weight: 500; font-size: 15px; transition: color 0.2s; white-space: nowrap;">Liên hệ</a></li>
                @if (Auth::guest())
                    <li style="white-space: nowrap;"><a href="{{ route('register') }}" style="color: #222; font-weight: 500; font-size: 15px; white-space: nowrap;">Đăng ký</a></li>
                    <li style="white-space: nowrap;"><a href="{{ route('login') }}" style="color: #222; font-weight: 500; font-size: 15px; white-space: nowrap;">Đăng nhập</a></li>
                @endif
            </ul>
        </div>
    </div>
    <style>
        .menu-bar ul li a:hover {
            color: #b8860b !important;
            text-decoration: underline;
        }
        @media (max-width: 900px) {
            .menu-bar ul {
                flex-direction: column;
                background: #f7d678;
                position: absolute;
                right: 0;
                top: 60px;
                width: 100%;
                display: none;
            }
            .menu-bar ul.show {
                display: flex;
            }
            .logo {
                text-align: center;
            }
        }
    </style>
    <!--TOP SECTION-->
@show