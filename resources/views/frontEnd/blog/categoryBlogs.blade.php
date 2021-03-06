@extends('layouts.frontEnd.app')

@section('title', 'Category Blogs')

<?php $pageActive = 'blogs' ?>

@section('content')
    <!--====== PAGE BANNER PART START ======-->
    <section id="page-banner" class="pt-105 pb-130 bg_cover" data-overlay="8" style="background-image: url({{ asset('storage/frontEnd/page-banner-4.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Blogs have <span style="text-decoration: underline; color: #ffc600">{{ $category->name }}</span> Category</h2>
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
            <div class="row">
                <div class="col-lg-8">
                    @forelse($catPosts as $catPost)
                    <div class="singel-blog mt-30">
                        <div class="blog-thum">
                            <img src="{{ asset('storage/' . $catPost->image) }}" alt="Blog">
                        </div>
                        <div class="blog-cont">
                            <a href="{{ route('blog.show', $catPost->id) }}"><h3>{{ $catPost->title }}</h3></a>
                            <ul>
                                <li><a href="#"><i class="fa fa-calendar"></i>{{ $catPost->created_at->format('d M Y') }}</a></li>
                                <li><a href="#"><i class="fa fa-user"></i>{{ $catPost->user->name }}</a></li>
                                <li><a href="#"><i class="fa fa-tags"></i>{{ $catPost->category->name }}</a></li>
                            </ul>
                            <p>{{ $catPost->description }}</p>
                            <a href="{{ route('blog.show', $catPost->id) }}" style="color: #ffc600; text-decoration: underline">Countinue Read</a>
                        </div>
                    </div> <!-- singel blog -->
                    @empty
                        <p class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Sorry, no blogs founded</p>
                    @endforelse
                </div>
                @include('layouts.frontEnd.blog.sideBar')
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
@endsection
