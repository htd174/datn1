@extends('layouts.dashboard')

@section('content')
    <div class="db-cent-2">
        <div class="db-2-main-1">
            <div class="db-2-main-2"> <img src="{{ asset("front/images/icon/dbc5.png") }}" alt=""> <span> Đặt phòng</span>
                <p></p>
                <h2>{{ $total_room_bookings }}</h2> </div>
        </div>
        <div class="db-2-main-1">
            <div class="db-2-main-2"> <img src="{{ asset("front/images/icon/dbc6.png") }}" alt=""> <span> Đặt sự kiện</span>
                <p></p>
                <h2>{{ $total_event_bookings }}</h2> </div>
        </div>
        <div class="db-2-main-1">
            <div class="db-2-main-2"> <img src="{{ asset("front/images/icon/dbc3.png") }}" alt=""> <span> Chưa thanh toán </span>
                <p></p>
                <h2>{{ $total_pending_payments }}</h2> </div>
        </div>
    </div>
    <div class="db-cent-3">
        <div class="db-cent-table db-com-table">
            <div class="db-title">
                <h3><img src="{{ asset("front/images/icon/dbc5.png") }}" alt=""/> Đặt phòng</h3>
                <p>Xem các đặt phòng sắp tới của bạn tại đây</p>
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
                            @endif
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td>Không tìm thấy đặt phòng nào.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="db-cent-3">
        <div class="db-cent-table db-com-table">
            <div class="db-title">
                <h3><img src="{{ asset("front/images/icon/dbc6.png") }}" alt=""/> Đặt sự kiện</h3>
                <p>Xem tất cả đặt sự kiện của bạn tại đây.</p>
            </div>
            <table class="bordered responsive-table">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Sự kiện</th>
                    <th>Địa điểm</th>
                    <th>Ngày</th>
                    <th>Số vé</th>
                    <th>Tổng chi phí</th>
                    <th>Trạng thái</th>
                    <th>Thanh toán</th>
                </tr>
                </thead>
                <tbody>
                @forelse($event_bookings as $index => $event_booking)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $event_booking->event->name}}</td>
                        <td>{{ $event_booking->event->venue}}</td>
                        <td>{{ \Carbon\Carbon::parse($event_booking->event->date)->format('d/m/Y') }}</td>
                        <td>{{ $event_booking->number_of_tickets }}</td>
                        <td>${{ $event_booking->total_cost }}</td>
                        <td>
                            @if($event_booking->status == true)
                                <span class="db-success">Đang hoạt động</span>
                            @else
                                <span class="db-not-success">Đã hủy</span>
                            @endif
                        </td>
                        <td>
                            @if($event_booking->payment == true)
                                <span class="db-success">Đã thanh toán</span>
                            @else
                                <span class="db-not-success">Chưa thanh toán</span>
                            @endif
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td>Không tìm thấy đặt sự kiện nào.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="db-cent-3">
        <div class="db-cent-acti">
            <div class="db-title">
                <h3><img src="{{ asset("front/images/icon/review.png") }}" alt=""/> Đánh giá của tôi</h3>
                <p>Các đánh giá gần đây bạn đã gửi.</p>
            </div>
            <ul>
                @forelse($room_booking_with_reviews as $room_booking)
                <li>
                    <div class="db-cent-wr-img"> <img src="{{ asset("front/images/users/3.png") }}" alt=""> </div>
                    <div class="db-cent-wr-con">
                        <h6>Đặt phòng khách sạn
                            @if($room_booking->status == "cancelled")
                                <span class="label label-danger">Đã hủy</span>
                            @elseif($room_booking->status == "checked_in")
                                <span class="label label-primary">Đã nhận phòng</span>
                            @elseif($room_booking->status == "checked_out")
                                <span class="label label-success">Đã trả phòng</span>
                            @endif
                        </h6>
                        <span class="lr-revi-date">Ngày đánh giá: {{ \Carbon\Carbon::parse($room_booking->review->updated_at)->format('Y-m-d') }}</span>
                        <br>
                        <span class="lr-revi-date">Đánh giá: {{ $room_booking->review->rating }}/5</span>

                        <p>
                            {{ $room_booking->review->review }}
                        </p>
                        <a href="{{ url('dashboard/room/booking/'.$room_booking->review->id.'/review') }}" class="btn btn-danger btn-sm">Cập nhật đánh giá</a>

                    </div>
                </li>
                    @empty
                    Hiện bạn chưa có đánh giá nào.
                    @endforelse
            </ul>
        </div>
    </div>
@endsection
