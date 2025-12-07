@extends('layouts.dashboard')

@section('content')

    <div class="db-cent-3">
        <div class="db-cent-table db-com-table">
            <div class="db-title">
                <h3><img src="{{ asset("front/images/icon/dbc5.png") }}" alt=""/> Đặt phòng của tôi</h3>
                <p>Xem tất cả đặt phòng khách sạn của bạn tại đây.</p>
            </div>
            <div class="db-title">
                @foreach ($errors->all() as $error)
                    <p style="color:red">{{ $error }}</p>
                @endforeach

                    @if(Session::has('flash_message'))
                        <p style="color:forestgreen">{{ Session::get('flash_title') }}, {{ Session::get('flash_message') }}</p>
                    @endif
            </div>
            <table class="bordered responsive-table">
                <thead>
                <tr>
                    <th>Số phòng</th>
                    <th>Loại</th>
                    <th>Ngày đến</th>
                    <th>Ngày đi</th>
                    <th>Tổng chi phí</th>
                    <th>Trạng thái</th>
                    <th>Thanh toán</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @forelse($room_bookings as $index => $room_booking)
                <tr>
                    <td>{{ $room_booking->room->room_number}}</td>
                    <td>{{ $room_booking->room->room_type->name}}</td>
                    <td>{{ $room_booking->arrival_date }}</td>
                    <td>{{ $room_booking->departure_date }}</td>
                    <td>${{ $room_booking->room_cost }}</td>
                    <td>
                        @if($room_booking->status == "pending")
                            <span class="label label-default">Đang chờ</span>
                        @elseif($room_booking->status == "checked_in")
                            <span class="label label-primary">Đã nhận phòng</span>
                        @elseif($room_booking->status == "checked_out")
                            <span class="label label-success">Đã trả phòng</span>
                        @else
                            <span class="label label-danger">Đã hủy</span>
                        @endif
                    </td>
                    <td>
                        @if($room_booking->payment == true)
                            <span class="db-success">Đã thanh toán</span>
                        @else
                            <span class="db-not-success">Chưa thanh toán</span>
                            @if($room_booking->status !== 'cancelled')
                                <a href="{{ route('payment.room', $room_booking->id) }}" class="btn btn-primary btn-sm">Thanh toán ngay</a>
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($room_booking->status !== 'pending' && $room_booking->status !== 'cancelled')
                            <a href="{{url('dashboard/room/booking/'.$room_booking->id.'/review')}}"><span class="label label-primary">Đánh giá</span></a>
                        @endif
                        @if($room_booking->status !== 'cancelled')
                            <a href="{{url('dashboard/room/booking/'.$room_booking->id.'/cancel')}}"><span class="label label-danger">Hủy</span></a>
                        @endif
                    </td>

                </tr>
                    @empty
                    <tr>
                        <td>Xin lỗi, không tìm thấy đặt phòng nào.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $room_bookings->links() }}
    </div>
@endsection
