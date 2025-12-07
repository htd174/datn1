@section('top_menu')
    @auth
        <div class="row">
            <div class="top-bar" style="display: flex; justify-content: flex-end; align-items: center; background: #f7d678; padding: 0.5rem 0;">
                <ul style="margin: 0; display: flex; align-items: center; list-style: none; background: none;">
                    <li style="margin-right: 25px; font-weight: 500; font-size: 15px;">
                        <i class="fa fa-phone" style="margin-right: 6px; color: #222;"></i>
                        <span style="color:#222">{{ config('app.phone_number', '09123456789') }}</span>
                    </li>
                    <li>
                        <a class='dropdown-button' href='#' data-activates='dropdown1' style="color:#222; font-weight: 500; font-size: 15px; display: flex; align-items: center;">
                            <i class="fa fa-user-circle" style="margin-right: 6px; color: #222;"></i> Tài khoản của tôi <i class="fa fa-angle-down" style="margin-left: 6px; color: #222;"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="all-drop-down">
            <!-- Cấu trúc menu thả -->
            <ul id='dropdown1' class='dropdown-content drop-con-man'>
                @if(Auth::user()->role == "admin")
                    <li>
                        <a href="{{ url('/admin') }}"><img src="{{ asset("front/images/icon/2.png") }}" alt=""> Quản trị viên</a>
                    </li>
                @endif
                <li>
                    <a href="{{ url('/dashboard') }}"><img src="{{ asset("front/images/icon/15.png") }}" alt=""> Bảng điều khiển</a>
                </li>
                <li>
                    <a href="{{ url('/dashboard/room/booking') }}"><img src="{{ asset("front/images/icon/1.png") }}" alt=""> Phòng đã đặt</a>
                </li>
                <li>
                    <a href="{{ url('/dashboard/event/booking') }}"><img src="{{ asset("front/images/icon/17.png") }}" alt=""> Sự kiện đã đặt</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <img src="{{ asset("front/images/icon/13.png") }}" alt=""> Đăng xuất</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    @endauth
@show