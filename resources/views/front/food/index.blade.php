@extends('layouts.front')

@section('content')
    <!--TOP BANNER-->
    <div class="inn-banner">
        <div class="container">
            <div class="row">
                <h4>Thực Đơn</h4>
                <p>Xem tất cả món ăn kiểu Âu được phục vụ tại khách sạn bởi các đầu bếp hàng đầu.</p>
            </div>
        </div>
    </div>
    @if(count($foods) > 0)
    <!--TOP SECTION-->
    <div class="inn-body-section pad-bot-65">
        <div class="container">
            <div class="row inn-page-com">
                <div class="page-head">
                    <h2>Khai vị</h2>
                    <div class="head-title">
                        <div class="hl-1"></div>
                        <div class="hl-2"></div>
                        <div class="hl-3"></div>
                    </div>
                    <p>Những món khai vị hấp dẫn giúp kích thích vị giác trước bữa ăn chính.</p>
                </div>
                <!--SERVICES SECTION-->
                <div class="col-md-12">
                    <div class="row">
                        @foreach($foods as $food)
                            @continue($food->type !== "Appetizer")
                        <div class="res-menu">
                            <img src="{{ ('storage/foods/'.$food->image) }}" alt="" />
                            <h3>{{ $food->name }} <span>${{ $food->price }}</span></h3>
                            <span class="menu-item">{{ $food->description }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row inn-page-com">
                <div class="page-head">
                    <h2>Súp</h2>
                    <div class="head-title">
                        <div class="hl-1"></div>
                        <div class="hl-2"></div>
                        <div class="hl-3"></div>
                    </div>
                    <p>Những món súp thơm ngon, bổ dưỡng được chế biến từ nguyên liệu tươi sạch.</p>
                </div>
                <!--SERVICES SECTION-->
                <div class="col-md-12">
                    <div class="row">
                        @foreach($foods as $food)
                            @continue($food->type !== "Soup")
                        <div class="res-menu">
                            <img src="{{ ('storage/foods/'.$food->image) }}" alt="" />
                            <h3>{{ $food->name }} <span>${{ $food->price }}</span></h3>
                            <span class="menu-item">{{ $food->description }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row inn-page-com">
                <div class="page-head">
                    <h2>Salad</h2>
                    <div class="head-title">
                        <div class="hl-1"></div>
                        <div class="hl-2"></div>
                        <div class="hl-3"></div>
                    </div>
                    <p>Salad thanh mát, giàu dinh dưỡng, phù hợp cho mọi khẩu vị.</p>
                </div>
                <!--SERVICES SECTION-->
                <div class="col-md-12">
                    <div class="row">
                        @foreach($foods as $food)
                            @continue($food->type !== "Salad")
                        <div class="res-menu">
                            <img src="{{ ('storage/foods/'.$food->image) }}" alt="" />
                            <h3>{{ $food->name }} <span>${{ $food->price }}</span></h3>
                            <span class="menu-item">{{ $food->description }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row inn-page-com">
                <div class="page-head">
                    <h2>Món chính</h2>
                    <div class="head-title">
                        <div class="hl-1"></div>
                        <div class="hl-2"></div>
                        <div class="hl-3"></div>
                    </div>
                    <p>Thưởng thức các món chính đặc sắc được chế biến bởi đầu bếp chuyên nghiệp.</p>
                </div>
                <!--SERVICES SECTION-->
                <div class="col-md-12">
                    <div class="row">
                        @foreach($foods as $food)
                            @continue($food->type !== "Main Course")
                        <div class="res-menu">
                            <img src="{{ ('storage/foods/'.$food->image) }}" alt="" />
                            <h3>{{ $food->name }} <span>${{ $food->price }}</span></h3>
                            <span class="menu-item">{{ $food->description }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row inn-page-com">
                <div class="page-head">
                    <h2>Món tráng miệng</h2>
                    <div class="head-title">
                        <div class="hl-1"></div>
                        <div class="hl-2"></div>
                        <div class="hl-3"></div>
                    </div>
                    <p>Những món ngọt nhẹ nhàng kết thúc bữa ăn một cách hoàn hảo.</p>
                </div>
                <!--SERVICES SECTION-->
                <div class="col-md-12">
                    <div class="row">
                        @foreach($foods as $food)
                            @continue($food->type !== "Dessert")
                        <div class="res-menu">
                            <img src="{{ ('storage/foods/'.$food->image) }}" alt="" />
                            <h3>{{ $food->name }} <span>${{ $food->price }}</span></h3>
                            <span class="menu-item">{{ $food->description }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--TOP SECTION-->
    @else
        Không có món ăn nào
    @endif
@endsection