@extends('layouts.front')

@section('style')
    <style>
        .review-list {
            list-style: none;
            padding: 0;
        }
        
        .review-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
            margin-bottom: 10px;
        }
        
        .review-user {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            object-fit: cover;
        }
        
        .user-info h5 {
            margin: 0;
            color: #333;
            font-size: 16px;
        }
        
        .rating {
            color: #ffc107;
            margin-left: 10px;
        }
        
        .review-date {
            color: #999;
            font-size: 12px;
        }
        
        .review-text {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
            margin: 10px 0;
        }
        
        .review-room {
            color: #999;
            font-size: 12px;
        }
        
        .latest-reviews-section {
            padding: 10px 0;
        }
        .section-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 18px;
            letter-spacing: 1px;
            text-align: left;
        }
        .latest-reviews-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .latest-review-item {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            margin-bottom: 18px;
            padding: 18px 16px 12px 16px;
            transition: box-shadow 0.2s;
        }
        .latest-review-item:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        }
        .review-header {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }
        .review-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 14px;
            border: 2px solid #eee;
        }
        .review-user-name {
            font-weight: 600;
            font-size: 16px;
            margin-right: 8px;
        }
        .review-rating {
            color: #ffc107;
            font-size: 15px;
        }
        .review-time {
            color: #888;
            font-size: 12px;
            margin-top: 2px;
        }
        .review-content {
            font-size: 15px;
            color: #333;
            margin-bottom: 8px;
            margin-left: 62px;
        }
        .review-room {
            font-size: 13px;
            color: #888;
            margin-left: 62px;
        }
    </style>
@endsection

@section('content')
    <!--Check Availability SECTION-->
    <div>
    <div class="slider fullscreen">
        <ul class="slides">
            @forelse($slider_images as $image)
            <li>
                <img src="{{'/storage/slider/'.$image->name}}" alt="">
                <div class="caption center-align slid-cap">
                    <h5 class="light grey-text text-lighten-3">{{ $image->small_title }}</h5>
                    <h2>{{ $image->big_title }}</h2>
                    <p>{{ $image->description }}</p>
                    <a href="{{ $image->link }}" class="waves-effect waves-light">{{ $image->link_text }}</a>
                </div>
            </li>
            @empty
            <li>
                <img src="{{ asset("front/images/slider/1.jpg") }}" alt="">
                <div class="caption center-align slid-cap">
                    <h5 class="light grey-text text-lighten-3">Đây là khẩu hiệu ngắn của chúng tôi.</h5>
                    <h2>Đây là thông điệp nổi bật!</h2>
                    <p>Phòng nghỉ tại Celestial Plaza Hotel mang đến không gian thoải mái, tiện nghi hiện đại và dịch vụ tận tâm, giúp bạn tận hưởng kỳ nghỉ trọn vẹn.</p>
                    <a href="#" class="waves-effect waves-light">Đặt phòng</a>
                </div>
            </li>
            @endforelse
        </ul>
    </div>
</div>

<!--PHẦN DANH SÁCH PHÒNG KHÁCH SẠN-->

@if(count($room_types) > 0)
<div class="hom1 hom-com pad-bot-40">
    <div class="container">
        <div class="row">
            <div class="hom1-title">
                <h2>Phòng khách sạn của chúng tôi</h2>
                <div class="head-title">
                    <div class="hl-1"></div>
                    <div class="hl-2"></div>
                    <div class="hl-3"></div>
                </div>
                <p>Mỗi kỳ nghỉ tại khách sạn đều mang đến trải nghiệm tuyệt vời và sự hiếu khách chu đáo.</p>
            </div>
        </div>
        <div class="row">
            <div class="to-ho-hotel">
                @foreach($room_types as $room_type)
                <div class="col-md-4">
                    <div class="to-ho-hotel-con">
                        <div class="to-ho-hotel-con-1">
                            @php $available = $room_type->getAvailableRoomsCount(); @endphp
                            <div class="hom-hot-av-tic" style="background: {{ $available == 0 ? '#e74c3c' : '#27ae60' }}; color: #fff;">
                                Số phòng còn trống: {{ $available }}
                            </div>
                            <img src="{{'/storage/room_types/'.$room_type->images->first()->name}}" alt="">
                        </div>
                        <div class="to-ho-hotel-con-23">
                            <div class="to-ho-hotel-con-2">
                                <a href="{{url('/room_type/'.$room_type->id)}}"><h4>{{ $room_type->name }}</h4></a>
                            </div>
                            <div class="to-ho-hotel-con-3">
                                <ul>
                                    <li>
                                        <div class="dir-rat-star ho-hot-rat-star"> Đánh giá:
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                        </div>
                                    </li>
                                    <li>
                                        @if($room_type->cost_per_day !== $room_type->discountedPrice)
                                        <span class="ho-hot-pri-dis">{{ $room_type->formattedCost }}</span>
                                        @endif
                                        <span class="ho-hot-pri">{{ $room_type->formattedDiscountedPrice }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

<!--PHẦN SỰ KIỆN-->

@if(count($events) > 0)
<div class="blog hom-com pad-bot-0">
    <div class="container">
        <div class="row">
            <div class="hom1-title">
                <h2>Sự kiện</h2>
                <div class="head-title">
                    <div class="hl-1"></div>
                    <div class="hl-2"></div>
                    <div class="hl-3"></div>
                </div>
                <p>Tham gia các sự kiện và hội nghị được tổ chức tại khách sạn của chúng tôi.</p>
            </div>
        </div>
        <div class="row">
            <div>
                @foreach($events as $event)
                <div class="col-md-3 n2-event">
                    <div class="n21-event hovereffect">
                        <img src="{{'/storage/events/'.$event->image}}" alt="">
                        <div class="overlay">
                            <a href="{{ url('/event/') }}"><span class="ev-book">Đặt ngay</span></a>
                        </div>
                    </div>
                    <div class="n22-event">
                        <a href="{{ url('/event/') }}"><h4>{{ $event->name }}</h4></a>
                        <span class="event-date">Ngày: {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }},</span>
                        <span class="event-by"> Giá: {{ $event->price > 0 ? number_format($event->price, 0, '.', ',').'₫' : 'Miễn phí' }}</span>
                        <p>{{ $event->description }}</p>
                        <div class="event-share">
                            <ul>
                                <li><a href="https://www.facebook.com/sharer.php?u={{ Request::url() }}" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://plus.google.com/share?url={{ Request::url() }}" title="Google Plus" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="https://twitter.com/share?url={{ Request::url() }}&text={{ $event->name }}" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://pinterest.com/pin/create/button/?url={{ Request::url() }}&media={{ $event->image }}&description={{ $event->name }}" title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
    <div class="blog hom-com pad-bot-0">
    <div class="container">
        <div class="row">
            <div class="hom1-title">
                <h2>Thư viện ảnh</h2>
                <div class="head-title">
                    <div class="hl-1"></div>
                    <div class="hl-2"></div>
                    <div class="hl-3"></div>
                </div>
                <p>Xem hình ảnh các phòng khách sạn, thực đơn món ăn và sự kiện</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="inn-services head-typo typo-com mar-bot-0">
                    <ul id="filters" class="clearfix">
                        <li><span class="filter active" data-filter=".room, .facilities, .food, .event">Tất cả</span></li>
                        <li><span class="filter" data-filter=".room">Phòng</span></li>
                        <li><span class="filter" data-filter=".food">Thực đơn</span></li>
                        <li><span class="filter" data-filter=".event">Sự kiện</span></li>
                    </ul>
                    <div id="portfoliolist">
                        <!-- Phòng -->
                        @foreach($room_types as $room_type)
                            <div class="portfolio room" data-cat="room">
                                <div class="portfolio-wrapper">
                                    <img src="{{'/storage/room_types/'.$room_type->images->last()->name}}" alt="" />
                                    <div class="label">
                                        <div class="label-text">
                                            <a class="text-title">{{ $room_type->name }}</a>
                                        </div>
                                        <div class="label-bg"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Sự kiện -->
                        @foreach($events as $event)
                            <div class="portfolio event" data-cat="event">
                                <div class="portfolio-wrapper">
                                    <img src="{{ '/storage/events/'.$event->image }}" alt="" />
                                    <div class="label">
                                        <div class="label-text">
                                            <a class="text-title">{{ $event->name }}</a>
                                        </div>
                                        <div class="label-bg"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Món ăn -->
                        @foreach($foods as $food)
                            <div class="portfolio food" data-cat="food">
                                <div class="portfolio-wrapper">
                                    <img src="{{ '/storage/foods/'.$food->image }}" alt="" />
                                    <div class="label">
                                        <div class="label-text">
                                            <a class="text-title">{{ $food->name }}</a>
                                        </div>
                                        <div class="label-bg"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blog hom-com">
    <div class="container">
        <div class="row">
            <div class="hom1-title">
                <h2>Xem thêm</h2>
                <div class="head-title">
                    <div class="hl-1"></div>
                    <div class="hl-2"></div>
                    <div class="hl-3"></div>
                </div>
            </div>
        </div>
        <div class="row">
            @if(count($slider_images)> 0)
            <div class="col-md-4">
                <div class="bot-gal h-gal">
                    <h4>Thư viện ảnh</h4>
                    <ul>
                        @foreach($slider_images as $image)
                        <li>
                            <img class="materialboxed" data-caption="{{ $image->big_title }}" src="{{ '/storage/slider/'.$image->name }}" alt="">
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <div class="col-md-4">
                <div class="bot-gal h-vid">
                    <h4>Thư viện video</h4>
                    <iframe src="{{config('app.video')}}?autoplay=0&amp;showinfo=0&amp;controls=0" allowfullscreen></iframe>
                    <h5>Video giới thiệu</h5>
                    <p>Xem video để tìm hiểu thêm về tiện nghi, dịch vụ và không gian khách sạn của chúng tôi</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="bot-gal h-blog latest-reviews-section">
                    <h4 class="section-title">Đánh giá mới nhất</h4>
                    <ul class="latest-reviews-list">
                        @if(count($reviews) > 0)
                            @foreach($reviews as $review)
                                <li class="latest-review-item" style="display: flex; align-items: flex-start; gap: 14px;">
                                    <img src="{{ asset('storage/avatars/' . $review->room_booking->user->avatar) }}" alt="avatar" class="review-avatar" style="width:48px;height:48px;border-radius:50%;object-fit:cover;flex-shrink:0;">
                                    <div style="flex:1;min-width:0;">
                                        <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                                            <span class="review-user-name" style="font-weight:600;font-size:15px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:120px;">{{ $review->room_booking->user->first_name }}</span>
                                            @if($review->rating > 0)
                                                <span class="review-rating">
                                                    @for($i=1; $i<=5; $i++)
                                                        <i class="fa fa-star{{ $i <= $review->rating ? '' : '-o' }}" style="color:#ffc107"></i>
                                                    @endfor
                                                </span>
                                            @endif
                                            <span class="review-time" style="color:#888;font-size:12px;">{{ \Carbon\Carbon::parse($review->updated_at)->diffForHumans() }}</span>
                                        </div>
                                        <div class="review-content" style="color:#333;font-size:14px;margin:6px 0 4px 0;word-break:break-word;">{{ $review->review }}</div>
                                        <div class="review-room" style="color:#888;font-size:13px;"><i class="fa fa-bed"></i> {{ $review->room_booking->room->room_type->name }}</div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li class="latest-review-item">Chưa có đánh giá nào</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection