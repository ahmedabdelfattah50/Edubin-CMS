@extends('layouts.frontEnd.app')

@section('title', 'Category Blogs')

@section('content')
    <!--====== PAGE BANNER PART START ======-->
    <section id="page-banner" class="pt-105 pb-130 bg_cover" data-overlay="8" style="background-image: url({{ asset('storage/frontEnd/page-banner-4.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Blogs have <span style="text-decoration: underline; color: #ffc600">{{ $tag->name }}</span> Tag</h2>
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
                    @forelse($tagPosts as $tagPost)
                    <div class="singel-blog mt-30">
                        <div class="blog-thum">
                            <img src="{{ asset('storage/' . $tagPost->image) }}" alt="Blog">
                        </div>
                        <div class="blog-cont">
                            <a href="{{ route('blog.show', $tagPost->id) }}"><h3>{{ $tagPost->title }}</h3></a>
                            <ul>
                                <li><a href="#"><i class="fa fa-calendar"></i>{{ $tagPost->created_at->format('d M Y') }}</a></li>
                                <li><a href="#"><i class="fa fa-user"></i>{{ $tagPost->user->name }}</a></li>
                                <li><a href="#"><i class="fa fa-tags"></i>{{ $tagPost->category->name }}</a></li>
                                @if($tagPost->tags->count() > 0)
                                    <li>
                                        <span class="d-flex">
                                            <i class="fa fa-hashtag" style="color: #ffc600;"></i><?php $i = 0 ?>
                                            @foreach($tagPost->tags as $postTag)
                                                @if($tagPost->tags->count() > 1)
                                                    <?php $i++ ?>
                                                    @if($i == $tagPost->tags->count())
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
                            <p>{{ $tagPost->description }}</p>
                            <a href="{{ route('blog.show', $tagPost->id) }}" style="color: #ffc600; text-decoration: underline">Countinue Read</a>
                        </div>
                    </div> <!-- singel blog -->
                    @empty
                        <p class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Sorry, no blogs founded</p>
                    @endforelse
                    {{-- <nav class="courses-pagination mt-50">
                        <ul class="pagination justify-content-lg-end justify-content-center">
                            <li class="page-item">
                                <a href="#" aria-label="Previous">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                            </li>
                            <li class="page-item"><a class="active" href="#">1</a></li>
                            <li class="page-item"><a href="#">2</a></li>
                            <li class="page-item"><a href="#">3</a></li>
                            <li class="page-item">
                                <a href="#" aria-label="Next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>  <!-- courses pagination -->
                    --}}
                </div>
                @include('layouts.frontEnd.blog.sideBar')
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
@endsection
