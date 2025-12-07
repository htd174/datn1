@extends('layouts.dashboard')

@section('content')

    <div class="db-cent-3">
        <div class="db-cent-table db-com-table">
            <div class="db-title">
                <h3><img src="{{ asset("front/images/icon/dbc5.png") }}" alt=""/> Đặt chỗ sự kiện của tôi</h3>
                <p>Xem tất cả đặt chỗ sự kiện của bạn tại đây.</p>
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
                    <th>STT</th>
                    <th>Sự kiện</th>
                    <th>Địa điểm</th>
                    <th>Ngày</th>
                    <th>Số vé</th>
                    <th>Tổng chi phí</th>
                    <th>Trạng thái</th>
                    <th>Thanh toán</th>
                    <th>Thao tác</th>
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
                            <a href="{{ route('payment.event', $event_booking->id) }}" class="btn btn-primary btn-sm">Thanh toán ngay</a>
                        @endif
                    </td>
                    <td>
                        @if($event_booking->status == true)
                            <a href="{{url('dashboard/event/booking/'.$event_booking->id.'/cancel')}}"><span class="label label-danger">Hủy</span></a>
                        @endif
                    </td>

                </tr>
                    @empty
                    <tr>
                        <td>Xin lỗi, không tìm thấy đặt chỗ nào.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $event_bookings->links() }}
    </div>
@endsection
