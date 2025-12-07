@extends('layouts.front')

@section('content')

    <div class="inn-body-section pad-bot-55">
        <div class="container">
            <div class="row">
                <div class="page-head">
                    <h2>Loại phòng</h2>
                    <div class="head-title">
                        <div class="hl-1"></div>
                        <div class="hl-2"></div>
                        <div class="hl-3"></div>
                    </div>
                    <p>Tất cả các loại phòng và suite hiện có được liệt kê bên dưới</p>
                </div>

            @forelse($room_types as $room_type)
                <!--ROOM SECTION-->
                <div class="room">
                    @if($room_type->cost_per_day !== $room_type->discountedPrice)
                    <div class="ribbon ribbon-top-left"><span>Giảm giá</span>
                    </div>
                    @endif
                    <!--ROOM IMAGE-->
                    <div class="r1 r-com"><img src="{{'/storage/room_types/'.$room_type->images->first()->name}}" alt="" />
                    </div>
                    <!--ROOM RATING-->
                    <div class="r2 r-com">
                        <h4>{{ $room_type->name }}</h4>

                        <div class="r2-ratt">
                            @if($room_type->getAggregatedRating() > 0)
                            <i class="fa fa-star"></i>
                            @endif
                            @if($room_type->getAggregatedRating() > 1)
                            <i class="fa fa-star"></i>
                            @endif
                            @if($room_type->getAggregatedRating() > 2)
                            <i class="fa fa-star"></i>
                            @endif
                            @if($room_type->getAggregatedRating() > 3)
                            <i class="fa fa-star"></i>
                            @endif
                            @if($room_type->getAggregatedRating() > 4)
                            <i class="fa fa-star"></i>
                            @endif
                            <p>
                                @if($room_type->getAggregatedRating() == 0)
                                    Chưa có đánh giá
                                @elseif($room_type->getAggregatedRating() <= 2)
                                    Dưới trung bình
                                @elseif($room_type->getAggregatedRating() <= 3)
                                    Đạt yêu cầu
                                @elseif($room_type->getAggregatedRating() <= 4)
                                    Tốt
                                @elseif($room_type->getAggregatedRating() <= 5)
                                    Xuất sắc
                                @endif
                                {{$room_type->getAggregatedRating()}} / 5
                            </p>
                        </div>
                        <ul>
                            <li>Tối đa người lớn: {{ $room_type->max_adult }}</li>
                            <li>Tối đa trẻ em: {{ $room_type->max_child }}</li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <!--ROOM AMINITIES-->
                    <div class="r3 r-com">
                        <ul>
                            @foreach($room_type->facilities as $facility)
                                <li>{{ $facility->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <!--ROOM PRICE-->
                    <div class="r4 r-com">
                        <p>Giá cho 1 đêm</p>
                        <p>
                            <span class="room-price-1">{{ $room_type->formattedDiscountedPrice }}</span>
                            @if($room_type->cost_per_day !== $room_type->discountedPrice)
                            <span class="room-price">{{ $room_type->formattedCost }}</span>
                            @endif
                        </p>
                        <p>Không hoàn tiền</p>
                    </div>
                    <!--ROOM BOOKING BUTTON-->
                    <div class="r5 r-com">
                        @if($room_type->getAvailableRoomsCount() > 0)
                            <div class="r2-available">{{ $room_type->getAvailableRoomsCount() }} phòng còn trống</div>
                            <p>Giá cho 1 đêm</p>
                            <a href="{{url('/room_type/'.$room_type->id)}}" class="inn-room-book">Đặt ngay</a>
                        @else
                            <div class="r2-not-available" style="color: red; font-size: 16px;">Hết phòng</div>
                            
                            <button class="inn-room-book" disabled style="background-color: #ccc;">Hết phòng</button>
                        @endif
                    </div>
                </div>
                <!--END ROOM SECTION-->
                @empty
                <!--ROOM SECTION-->
                    <div class="room">
                        </div>
                        <!--ROOM IMAGE-->
                        <div class="r1 r-com"><img src="{{ asset("front/images/room/1.jpg") }}" />
                        </div>
                        <!--ROOM RATING-->
                        <div class="r2 r-com">
                            <h4>Phòng Suite Cao Cấp</h4>
                            <div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <img src="images/h-trip.png" alt="" /> <span>Xuất sắc  4.5 / 5</span> </div>
                            <ul>
                                <li>Tối đa người lớn: 3</li>
                                <li>Tối đa trẻ em: 1</li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                        <!--ROOM AMINITIES-->
                        <div class="r3 r-com">
                            <ul>
                                <li>Dụng cụ là ủi</li>
                                <li>Máy pha trà/cà phê</li>
                                <li>Điều hòa</li>
                                <li>TV màn hình phẳng</li>
                                <li>Dịch vụ đánh thức</li>
                            </ul>
                        </div>
                        <!--ROOM PRICE-->
                        <div class="r4 r-com">
                            <p>Giá cho 1 đêm</p>
                            <p><span class="room-price-1">5000</span> <span class="room-price">$: 7000</span>
                            </p>
                            <p>Không hoàn tiền</p>
                        </div>
                        <!--ROOM BOOKING BUTTON-->
                        <div class="r5 r-com">
                            <div class="r2-available">Còn trống</div>
                            <p>Giá cho 1 đêm</p> <a href="room-details-block.html" class="inn-room-book">Đặt ngay</a> </div>
                    </div>
                    <!--END ROOM SECTION-->
                <!--ROOM SECTION-->
                <div class="room">
                    <div class="ribbon ribbon-top-left"><span>Nổi bật</span>
                    </div>
                    <!--ROOM IMAGE-->
                    <div class="r1 r-com"><img src="images/room/2.jpg" alt="" />
                    </div>
                    <!--ROOM RATING-->
                    <div class="r2 r-com">
                        <h4>Phòng Suite Nhỏ</h4>
                        <div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <img src="images/h-trip.png" alt="" /> <span>Xuất sắc  4.2 / 5</span> </div>
                        <ul>
                            <li>Tối đa người lớn: 2</li>
                            <li>Tối đa trẻ em: 2</li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <!--ROOM AMINITIES-->
                    <div class="r3 r-com">
                        <ul>
                            <li>Dụng cụ là ủi</li>
                            <li>Máy pha trà/cà phê</li>
                            <li>Điều hòa</li>
                            <li>TV màn hình phẳng</li>
                            <li>Dịch vụ đánh thức</li>
                        </ul>
                    </div>
                    <!--ROOM PRICE-->
                    <div class="r4 r-com">
                        <p>Giá cho 1 đêm</p>
                        <p><span class="room-price-1">4000</span> <span class="room-price">$: 4500</span>
                        </p>
                        <p>Không hoàn tiền</p>
                    </div>
                    <!--ROOM BOOKING BUTTON-->
                    <div class="r5 r-com">
                        <div class="r2-available">Còn trống</div>
                        <p>Giá cho 1 đêm</p> <a href="room-details.html" class="inn-room-book">Đặt ngay</a> </div>
                </div>
                <!--END ROOM SECTION-->
                <!--ROOM SECTION-->
                <div class="room">
                    <!--<div class="ribbon ribbon-top-left"><span>Nổi bật</span></div>
                    -->
                    <!--ROOM IMAGE-->
                    <div class="r1 r-com"><img src="images/room/3.jpg" alt="" />
                    </div>
                    <!--ROOM RATING-->
                    <div class="r2 r-com">
                        <h4>Phòng Siêu Deluxe</h4>
                        <div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <img src="images/h-trip.png" alt="" /> <span>Xuất sắc  3.9 / 5</span> </div>
                        <ul>
                            <li>Tối đa người lớn: 4</li>
                            <li>Tối đa trẻ em: 2</li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <!--ROOM AMINITIES-->
                    <div class="r3 r-com">
                        <ul>
                            <li>Dụng cụ là ủi</li>
                            <li>Máy pha trà/cà phê</li>
                            <li>Điều hòa</li>
                            <li>TV màn hình phẳng</li>
                            <li>Dịch vụ đánh thức</li>
                        </ul>
                    </div>
                    <!--ROOM PRICE-->
                    <div class="r4 r-com">
                        <p>Giá cho 1 đêm</p>
                        <p><span class="room-price-1">3500</span> <span class="room-price">$: 4000</span>
                        </p>
                        <p>Không hoàn tiền</p>
                    </div>
                    <!--ROOM BOOKING BUTTON-->
                    <div class="r5 r-com">
                        <div class="r2-available">Còn trống</div>
                        <p>Giá cho 1 đêm</p> <a href="room-details-1.html" class="inn-room-book">Đặt ngay</a> </div>
                </div>
                <!--END ROOM SECTION-->
                <!--ROOM SECTION-->
                <div class="room">
                    <!--<div class="ribbon ribbon-top-left"><span>Phòng tốt nhất</span></div>-->
                    <!--ROOM IMAGE-->
                    <div class="r1 r-com"><img src="images/room/4.jpg" alt="" />
                    </div>
                    <!--ROOM RATING-->
                    <div class="r2 r-com">
                        <h4>Phòng Sang Trọng</h4>
                        <div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <img src="images/h-trip.png" alt="" /> <span>Xuất sắc  4.0 / 5</span> </div>
                        <ul>
                            <li>Tối đa người lớn: 5</li>
                            <li>Tối đa trẻ em: 2</li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <!--ROOM AMINITIES-->
                    <div class="r3 r-com">
                        <ul>
                            <li>Dụng cụ là ủi</li>
                            <li>Máy pha trà/cà phê</li>
                            <li>Điều hòa</li>
                            <li>TV màn hình phẳng</li>
                            <li>Dịch vụ đánh thức</li>
                        </ul>
                    </div>
                    <!--ROOM PRICE-->
                    <div class="r4 r-com">
                        <p>Giá cho 1 đêm</p>
                        <p><span class="room-price-1">30</span> <span class="room-price">$: 3500</span>
                        </p>
                        <p>Không hoàn tiền</p>
                    </div>
                    <!--ROOM BOOKING BUTTON-->
                    <div class="r5 r-com">
                        <div class="r2-available">Còn trống</div>
                        <p>Giá cho 1 đêm</p> <a href="room-details.html" class="inn-room-book">Đặt ngay</a> </div>
                </div>
                <!--END ROOM SECTION-->
                <!--ROOM SECTION-->
                <div class="room">
                    <div class="ribbon ribbon-top-left"><span>Đặc biệt</span>
                    </div>
                    <!--ROOM IMAGE-->
                    <div class="r1 r-com"><img src="images/room/5.jpg" alt="" />
                    </div>
                    <!--ROOM RATING-->
                    <div class="r2 r-com">
                        <h4>Phòng Cao Cấp</h4>
                        <div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <img src="images/h-trip.png" alt="" /> <span>Xuất sắc  4.5 / 5</span> </div>
                        <ul>
                            <li>Tối đa người lớn: 5</li>
                            <li>Tối đa trẻ em: 2</li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <!--ROOM AMINITIES-->
                    <div class="r3 r-com">
                        <ul>
                            <li>Dụng cụ là ủi</li>
                            <li>Máy pha trà/cà phê</li>
                            <li>Điều hòa</li>
                            <li>TV màn hình phẳng</li>
                            <li>Dịch vụ đánh thức</li>
                        </ul>
                    </div>
                    <!--ROOM PRICE-->
                    <div class="r4 r-com">
                        <p>Giá cho 1 đêm</p>
                        <p><span class="room-price-1">4000</span> <span class="room-price">$: 5000</span>
                        </p>
                        <p>Không hoàn tiền</p>
                    </div>
                    <!--ROOM BOOKING BUTTON-->
                    <div class="r5 r-com">
                        <div class="r2-available">Còn trống</div>
                        <p>Giá cho 1 đêm</p> <a href="room-details-block.html" class="inn-room-book">Đặt ngay</a> </div>
                </div>
                <!--END ROOM SECTION-->
                <!--ROOM SECTION-->
                <div class="room">
                    <!--<div class="ribbon ribbon-top-left"><span>Nổi bật</span></div>-->
                    <!--ROOM IMAGE-->
                    <div class="r1 r-com"><img src="images/room/6.jpg" alt="" />
                    </div>
                    <!--ROOM RATING-->
                    <div class="r2 r-com">
                        <h4>Phòng Tiêu Chuẩn</h4>
                        <div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <img src="images/h-trip.png" alt="" /> <span>Xuất sắc  3.5 / 5</span> </div>
                        <ul>
                            <li>Tối đa người lớn: 4</li>
                            <li>Tối đa trẻ em: 4</li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <!--ROOM AMINITIES-->
                    <div class="r3 r-com">
                        <ul>
                            <li>Dụng cụ là ủi</li>
                            <li>Máy pha trà/cà phê</li>
                            <li>Điều hòa</li>
                            <li>TV màn hình phẳng</li>
                            <li>Dịch vụ đánh thức</li>
                        </ul>
                    </div>
                    <!--ROOM PRICE-->
                    <div class="r4 r-com">
                        <p>Giá cho 1 đêm</p>
                        <p><span class="room-price-1">2000</span> <span class="room-price">$: 2500</span>
                        </p>
                        <p>Không hoàn tiền</p>
                    </div>
                    <!--ROOM BOOKING BUTTON-->
                    <div class="r5 r-com">
                        <div class="r2-available">Còn trống</div>
                        <p>Giá cho 1 đêm</p> <a href="room-details.html" class="inn-room-book">Đặt ngay</a> </div>
                </div>
                <!--END ROOM SECTION-->
                @endforelse
            </div>
        </div>
@endsection
