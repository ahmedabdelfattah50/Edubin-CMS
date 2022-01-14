@extends('layouts.frontEnd.app')

@section('title', 'Blogs')

@section('content')
    <!--====== PAGE BANNER PART START ======-->
    <section id="page-banner" class="pt-105 pb-130 bg_cover" data-overlay="8" style="background-image: url({{ asset('storage/frontEnd/page-banner-4.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Blogs</h2>
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
                    @foreach($posts as $post)
                    <div class="singel-blog mt-30">
                        <div class="blog-thum">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Blog">
                        </div>
                        <div class="blog-cont">
                            <a href="{{ route('blog.show', $post->id) }}"><h3>{{ $post->title }}</h3></a>
                            <ul>
                                <li><a href="#"><i class="fa fa-calendar"></i>25 Dec 2018</a></li>
                                <li><a href="#"><i class="fa fa-user"></i>{{ $post->user->name }}</a></li>
                                <li><a href="#"><i class="fa fa-tags"></i>{{ $post->category->name }}</a></li>
                            </ul>
                            <p>{{ $post->description }}</p>
                            <a href="{{ route('blog.show', $post->id) }}" style="color: #ffc600; text-decoration: underline">Countinue Read</a>
                        </div>
                    </div> <!-- singel blog -->
                    @endforeach
{{--                    <div class="singel-blog mt-30">--}}
{{--                        <div class="blog-thum">--}}
{{--                            <img src="{{ asset('storage/frontEnd/blog/b-2.jpg') }}" alt="Blog">--}}
{{--                        </div>--}}
{{--                        <div class="blog-cont">--}}
{{--                            <a href="blog-singel.html"><h3>Few tips for get better results in examination</h3></a>--}}
{{--                            <ul>--}}
{{--                                <li><a href="#"><i class="fa fa-calendar"></i>25 Dec 2018</a></li>--}}
{{--                                <li><a href="#"><i class="fa fa-user"></i>Mark anthem</a></li>--}}
{{--                                <li><a href="#"><i class="fa fa-tags"></i>Education</a></li>--}}
{{--                            </ul>--}}
{{--                            <p>Lorem ipsum gravida nibh vel velit auctor aliquetn sollicitudirem quibibendum auci elit cons equat ipsutis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus .</p>--}}
{{--                        </div>--}}
{{--                    </div> <!-- singel blog -->--}}
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
