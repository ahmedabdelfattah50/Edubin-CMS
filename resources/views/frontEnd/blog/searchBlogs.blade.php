@extends('layouts.frontEnd.app')

@section('title', 'Search Blogs')

<?php $pageActive = 'blogs' ?>

@section('content')
    <!--====== PAGE BANNER PART START ======-->
    <section id="page-banner" class="pt-105 pb-130 bg_cover" data-overlay="8" style="background-image: url({{ asset('storage/frontEnd/page-banner-4.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Blogs have word '<span style="text-decoration: underline; color: #ffc600">{{ $searchWord }}</span>'</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Blogs</li>
                            </ol>
                        </nav>
                    </div>  <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== PAGE BANNER PART ENDS ======-->

    <section id="blog-page" class="pt-90 pb-120 gray-bg">
        <div class="container">
            <h5 style="font-weight: 900"><span style="color: #fcc200; font-weight: 900">{{ $searchPostResults->count() }}'</span> Results</h5>
            <div class="row">
                <div class="col-lg-8">
                    @forelse($searchPostResults as $postResult)
                    <div class="singel-blog mt-30">
                        <div class="blog-thum">
                            <img src="{{ asset('storage/' . $postResult->image) }}" alt="Blog">
                        </div>
                        <div class="blog-cont">
                            <a href="{{ route('blog.show', $postResult->id) }}"><h3>{{ $postResult->title }}</h3></a>
                            <ul>
                                <li><a href="#"><i class="fa fa-calendar"></i>{{ $postResult->created_at->format('d M Y') }}</a></li>
                                <li><a href="#"><i class="fa fa-user"></i>{{ $postResult->user->name }}</a></li>
                                <li><a href="#"><i class="fa fa-tags"></i>{{ $postResult->category->name }}</a></li>
                                @if($postResult->tags->count() > 0)
                                    <li>
                                        <span class="d-flex">
                                            <i class="fa fa-hashtag" style="color: #ffc600;"></i><?php $i = 0 ?>
                                            @foreach($postResult->tags as $postTag)
                                                @if($postResult->tags->count() > 1)
                                                    <?php $i++ ?>
                                                    @if($i == $postResult->tags->count())
                                                        <a class="ml-1 p-0" href="{{ route('tag-blogs', $postTag->id) }}">{{ $postTag->name }}</a>
                                                    @else
                                                        <a class="ml-1 p-0 mr-1" href="{{ route('tag-blogs', $postTag->id) }}">{{ $postTag->name }}</a> /
                                                    @endif
                                                @else
                                                    <a class="ml-1 p-0" href="{{ route('tag-blogs', $postTag->id) }}">{{ $postTag->name }}</a>
                                                @endif
                                            @endforeach
                                        </span>
                                    </li>
                                @endif
                            </ul>
                            <p>{{ $postResult->description }}</p>
                            <a href="{{ route('blog.show', $postResult->id) }}" style="color: #ffc600; text-decoration: underline">Countinue Read</a>
                        </div>
                    </div> <!-- singel blog -->
                    @empty
                        <p class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> OOPS, No blogs founded</p>
                    @endforelse
                </div>
                @include('layouts.frontEnd.blog.sideBar')
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
@endsection
