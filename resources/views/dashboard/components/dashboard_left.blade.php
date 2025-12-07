@section('dashboard_left')
    <div class="db-left" style="background: #f2eeee;">
        <div class="db-left-1" style="padding: 30px;">
            <div style="
                width: 100%;
                height: 200px;
                margin: 0 auto 15px auto;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}"
                     alt="{{ Auth::user()->first_name }}'s avatar"
                     style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <h4 style="color: #222; text-align: center; margin-bottom: 5px;">{{ Auth::user()->first_name }}</h4>
            <p style="color: #222; text-align: center; font-size: 14px;">{{ Auth::user()->address }}</p>
        </div>

        <div class="db-left-2">
            <ul>
                <li>
                    <a href="{{ url('/dashboard') }}" style="color: #222;"><img src="{{ asset("front/images/icon/db1.png") }}" alt="" style="filter: brightness(0);" /> Tất cả</a>
                </li>
                <li>
                    <a href="{{ url('/dashboard/room/booking') }}" style="color: #222;"><img src="{{ asset("front/images/icon/db2.png") }}" alt="" style="filter: brightness(0);" /> Phòng</a>
                </li>
                <li>
                    <a href="{{ url('/dashboard/event/booking') }}" style="color: #222;"><img src="{{ asset("front/images/icon/db4.png") }}" alt="" style="filter: brightness(0);" /> Sự kiện</a>
                </li>
                <li>
                    <a href="{{ url('/dashboard/profile') }}" style="color: #222;"><img src="{{ asset("front/images/icon/db7.png") }}" alt="" style="filter: brightness(0);" /> Hồ sơ</a>
                </li>
                <li>
                    <a href="{{ url('/dashboard/setting') }}" alt="Đổi mật khẩu" style="color: #222;"><img src="{{ asset("front/images/icon/key.png") }}" alt="Đổi mật khẩu" style="filter: brightness(0);" /> Mật khẩu</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-dash-form').submit();" style="color: #222;"><img src="{{ asset("front/images/icon/db8.png") }}" alt="" style="filter: brightness(0);" /> Đăng xuất</a>
                </li>
            </ul>
        </div>
    </div>

    <form id="logout-dash-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @show