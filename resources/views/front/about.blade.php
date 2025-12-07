@extends('layouts.front')

@section('content')
    @php
        $displayTitle = mb_strtolower($page->title, 'UTF-8') === 'about' ? 'Giới thiệu' : $page->title;
    @endphp

    <div class="inn-banner">
        <div class="container">
            <div class="row">
                <h4>{{ $displayTitle }}</h4>
                <p> </p>
                <ul>
                    <li><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li><a href="{{ url($page->url_title) }}">{{ $page->title }}</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="inn-body-section">
        <div class="container">
            <div class="row">
                <div class="page-head">
                    <h2>{{ $displayTitle }}</h2>
                    <div class="head-title">
                        <div class="hl-1"></div>
                        <div class="hl-2"></div>
                        <div class="hl-3"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <p class="about-description">{{ $page->description }}</p>
            </div>
        </div>
    </div>
    <style>
        .about-description {
            font-size: 20px;
            line-height: 1.8;
            color: #333;
        }
    </style>
@endsection