@extends('layouts.frontEnd.app')

@section('title', 'Blog')

<?php $pageActive = 'blogs' ?>

@section('content')
    <!--====== PAGE BANNER PART START ======-->

    <section id="page-banner" class="pt-105 pb-130 bg_cover" data-overlay="8" style="background-image: url({{ asset('storage/frontEnd/page-banner-4.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>{{ $post->title }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Blogs</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                            </ol>
                        </nav>
                    </div>  <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== PAGE BANNER PART ENDS ======-->

    <!--====== BLOG PART START ======-->

    <section id="blog-singel" class="pt-90 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-details mt-30">
                        <div class="thum">
                            <img width="100%" src="{{ asset('storage/' . $post->image ) }}" alt="Blog Details">
                        </div>
                        <div class="cont">
                            <h3>{{ $post->title }}</h3>
                            <ul>
                                <li><a href="#"><i class="fa fa-calendar"></i>{{ $post->created_at->format('d M Y') }}</a></li>
                                <li><a href="{{ route('writer.data', $post->user->id) }}"><i class="fa fa-user"></i>{{ $post->user->name }}</a></li>
                                <li><a href="#"><i class="fa fa-tags"></i>{{ $post->category->name }}</a></li>
                                @if($post->tags->count() > 0)
                                    <li>
                                        <span class="d-flex">
                                            <i class="fa fa-hashtag" style="color: #ffc600;"></i><?php $i = 0 ?>
                                            @foreach($post->tags as $postTag)
                                                @if($post->tags->count() > 1)
                                                    <?php $i++ ?>
                                                    @if($i == $post->tags->count())
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
                            <h4 style="color: #ffc600;">Description: </h4>
                            <p>{{ $post->description }}</p>
                            <h4 style="color: #ffc600;">Content: </h4>
                            <p>{!! $post->content !!}</p>
                            <ul class="share" style="border: none; padding-bottom: 0">
                                <li class="title">Share :</li>
                                <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>

                            {{-- ###### comment ###### --}}
                            {{--
                            <div class="blog-comment pt-45">
                                <div class="title pb-15">
                                    <h3>Comment (3)</h3>
                                </div>  <!-- title -->
                                <ul>
                                     <li>
                                        <div class="comment">
                                            <div class="comment-author">
                                                <div class="author-thum">
                                                    <img src="{{ asset('storage/frontEnd/review/r-1.jpg') }}" alt="Reviews">
                                                </div>
                                                <div class="comment-name">
                                                    <h6>Bobby Aktar</h6>
                                                    <span>April 03, 2019</span>
                                                </div>
                                            </div>
                                            <div class="comment-description pt-20">
                                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which.</p>
                                            </div>
                                            <div class="comment-replay">
                                                <a href="#">Reply</a>
                                            </div>
                                        </div> <!-- comment -->
                                        <ul class="replay">
                                            <li>
                                                <div class="comment">
                                                    <div class="comment-author">
                                                        <div class="author-thum">
                                                            <img src="{{ asset('storage/frontEnd/review/r-2.jpg') }}" alt="Reviews">
                                                        </div>
                                                        <div class="comment-name">
                                                            <h6>Humayun Ahmed</h6>
                                                            <span>April 03, 2019</span>
                                                        </div>
                                                    </div>
                                                    <div class="comment-description pt-20">
                                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                                                    </div>
                                                    <div class="comment-replay">
                                                        <a href="#">Reply</a>
                                                    </div>
                                                </div> <!-- comment -->
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <div class="title pt-45 pb-25">
                                    <h3>Leave a comment</h3>
                                </div> <!-- title -->
                                <div class="comment-form">
                                    <form action="#">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-singel">
                                                    <input type="text" placeholder="Name">
                                                </div> <!-- form singel -->
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-singel">
                                                    <input type="email" placeholder="email">
                                                </div> <!-- form singel -->
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-singel">
                                                    <textarea placeholder="Comment"></textarea>
                                                </div> <!-- form singel -->
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-singel">
                                                    <button class="main-btn">Submit</button>
                                                </div> <!-- form singel -->
                                            </div>
                                        </div> <!-- row -->
                                    </form>
                                </div>  <!-- comment-form -->
                            </div> <!-- blog comment -->
                            --}}
                        </div> <!-- cont -->
                    </div> <!-- blog details -->
                </div>

                @include('layouts.frontEnd.blog.sideBar')

            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    <!--====== BLOG PART ENDS ======-->
@endsection
