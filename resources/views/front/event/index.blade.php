@extends('layouts.front')

@section('content')
    <div class="inn-body-section pad-bot-55">
        <div class="container">
            <div class="row">
                <div class="page-head">
                    <h2>Tất cả sự kiện</h2>
                    <div class="head-title">
                        <div class="hl-1"></div>
                        <div class="hl-2"></div>
                        <div class="hl-3"></div>
                    </div>
                    <p>Các sự kiện được tổ chức tại khách sạn của chúng tôi được liệt kê bên dưới.</p>
                </div>
                <!--TYPOGRAPHY SECTION-->
                @if(count($events) > 0)
                    <div class="col-md-12">
                        <div class="head-typo typo-com">
                            <h2>Sự kiện sắp diễn ra</h2>
                            <p>Danh sách các sự kiện sắp tổ chức tại khách sạn</p>
                            @foreach($events as $event)
                            {!! Form::open(array('url' => 'event/'.$event->id.'/book', 'class' => 'col s12')) !!}
                            {{ Form::hidden('_method', 'POST') }}
                            @csrf
                            @continue($event->date < today()->format('Y-m-d'))
                            <!--EVENT-->

                            <div class="row events">

                                @if ($errors->has('number_of_tickets'))
                                    <div class="col-md-12 alert alert-danger">
                                        <strong>Sorry!</strong> {{ $errors->first('number_of_tickets') }}
                                    </div>
                                @endif
                                <div class="col-md-2"> <img src="{{ ('storage/events/'. $event->image) }}" alt="" /> </div>
                                <div class="col-md-8">
                                    <h3>{{ $event->name }}</h3> <span><strong>Ngày: </strong> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</span>
                                    <p><strong>Giá: </strong>${{ $event->price }}/1</p>
                                    <p>{{ $event->description }}</p>
                                </div>
                                <div class="col-md-2"> <span style="font-weight: bold">Số vé</span> </div>
                                <div class="input-field col-md-2">
                                   <input style="margin-bottom: 10px; height: 40px;" type="text" name="number_of_tickets">
                                </div>
                                <div class="col-md-2"> <input id="register-button" type="submit" value="Đăng ký" class="waves-effect waves-light event-regi"> </div>

                            </div>
                            <!--END EVENT-->
                            {!! Form::close() !!}
                             @endforeach
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="head-typo typo-com">
                            <h2>Sự kiện đã diễn ra</h2>
                            <p>Các sự kiện đã tổ chức tại khách sạn</p>
                            @foreach($events as $event)
                            @continue($event->date > today()->format('Y-m-d') || $event->date == today()->format('Y-m-d'))
                            <!--EVENT-->
                                <div class="row events">
                                    <div class="col-md-2"> <img src="{{ ('storage/events/'. $event->image) }}" alt="" /> </div>
                                    <div class="col-md-8">
                                        <h3>{{ $event->name }}</h3> <span><strong>Ngày: </strong> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</span>
                                        <p><strong>Giá: </strong>${{ $event->price }}/1</p>
                                        <p>{{ $event->description }}</p>
                                    </div>
                                </div>
                                <!--END EVENT-->
                            @endforeach
                        </div>
                    </div>
                @else

                    <h3>Hiện chưa có sự kiện nào được tổ chức tại khách sạn.</h3>
                @endif
                <!--END TYPOGRAPHY SECTION-->
            </div>
        </div>
    </div>
@endsection
