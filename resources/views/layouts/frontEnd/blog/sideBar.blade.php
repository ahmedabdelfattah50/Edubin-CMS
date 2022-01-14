<!--====== BLOG PART START ======-->

            <div class="col-lg-4">
                <div class="saidbar">
                    <div class="row">
                        <div class="col-lg-12 col-md-6">
                            <div class="saidbar-search mt-30">
                                <form action="{{ route('blogs.search') }}" method="GET">
                                    <input type="text" name="search" placeholder="Search">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div> <!-- saidbar search -->
                            <div class="categories mt-30">
                                <h4>Categories</h4>
                                <ul>
                                    @forelse($categories as $category)
                                        <li><a href="{{ route('category-blogs', $category->id) }}">{{ $category->name }} <span class="badge badge-warning">{{ $category->posts->count() }}</span></a></li>
                                    @empty
                                        <p class="alert alert-danger">Oops, Sorry no data founded.</p>
                                    @endforelse
                                </ul>
                            </div>

                            <div class="categories mt-30">
                                <h4>Tags</h4>
                                <ul>
                                    @forelse($tags as $tag)
                                        <li><a href="{{ route('tag-blogs', $tag->id) }}">{{ $tag->name }} <span class="badge badge-warning">{{ $tag->posts->count() }}</span></a></li>
                                    @empty
                                        <p class="alert alert-danger">Oops, Sorry no data founded.</p>
                                    @endforelse
                                </ul>
                            </div>
                        </div> <!-- categories -->
                        <div class="col-lg-12 col-md-6">
                            <div class="saidbar-post mt-30">
                                <h4>Popular Posts</h4>
                                <ul>
                                    <?php $i = 0; ?>
                                    @forelse($posts as $post)
                                        @if($i < 3)
                                            <li>
                                                <a href="{{ route('blog.show', $post->id) }}">
                                                    <div class="singel-post">
                                                        <div class="thum">
                                                            <img width="92" height="92" src="{{ asset('storage/' . $post->image ) }}" alt="Blog">
                                                        </div>
                                                        <div class="cont">
                                                            <h6>{{ $post->title }}</h6>
                                                            <span>{{ $post->created_at->format('d M Y') }}</span>
                                                        </div>
                                                    </div> <!-- singel post -->
                                                </a>
                                            </li>
                                            <?php $i++ ?>
                                        @endif
                                    @empty
                                        <p class="alert alert-danger">Oops, Sorry no data founded.</p>
                                    @endforelse
                                </ul>
                            </div> <!-- saidbar post -->
                        </div>
                    </div> <!-- row -->
                </div> <!-- saidbar -->
            </div>

<!--====== BLOG PART ENDS ======-->
