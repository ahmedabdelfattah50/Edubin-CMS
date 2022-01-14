@extends('layouts.frontEnd.app')

@section('title', 'Blog')

@section('content')

    <!--====== PAGE BANNER PART START ======-->

    <section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8" style="background-image: url({{ asset('storage/frontEnd/page-banner-1.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>About {{ $writer->name }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $writer->name }}</li>
                            </ol>
                        </nav>
                    </div>  <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== PAGE BANNER PART ENDS ======-->

    <!--====== ABOUT PART START ======-->

    <section id="about-page" class="pt-70 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title mt-50">
                        <h5>About</h5>
                        <h2>{{ $writer->name }}</h2>
                    </div> <!-- section title -->
                    <div class="about-cont">
                        <p>{{ $writer->profile->about }}</p>
                    </div>
                    <div class="about-cont">
                        <ul class="d-flex text-decoration-none">
                            @if($writer->profile->linkedin)
                                <li class="pr-4" style="font-size: 20px;"><a href="#" target="_blank" style="color:#ffc600"><i class="fa fa-linkedin"></i></a></li>
                            @endif
                            @if($writer->profile->facebook)
                                <li class="pr-4" style="font-size: 20px;"><a href="#" target="_blank" style="color:#ffc600"><i class="fa fa-facebook-f"></i></a></li>
                            @endif
                            @if($writer->profile->twitter)
                                <li class="pr-4" style="font-size: 20px;"><a href="#" target="_blank" style="color:#ffc600"><i class="fa fa-twitter"></i></a></li>
                            @endif
                            @if($writer->profile->instagram)
                                <li class="pr-4" style="font-size: 20px;"><a href="#" target="_blank" style="color:#ffc600"><i class="fa fa-instagram"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div> <!-- about cont -->
                <div class="col-lg-7">
                    <div class="about-image mt-50">
                        @if($writer->profile->avatar == null)
                            <img src="{{ asset('storage/images/default_avatar.png') }}" alt="{{ $writer->name }}">
                        @else
                            <img src="{{ asset('storage/' . $writer->profile->avatar) }}" alt="{{ $writer->name }}">
                        @endif
                    </div>  <!-- about imag -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    <!--====== ABOUT PART ENDS ======-->

@endsection
