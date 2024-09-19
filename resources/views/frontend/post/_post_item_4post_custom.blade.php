@php
    $posts= App\Models\Post::latest()->limit(8)->get();
@endphp
<section class="section latest-blog outer-bottom-vs wow fadeInUp">
    <h3 class="section-title">Bài viết được yêu thích nhất</h3>
    @foreach ($posts->chunk(4) as $items )
    <div class="row" style="padding-left: 20px; margin-top: 20px;">

        @foreach ($items as $post)
        <div class="col-sm-6 col-md-3" style="margin-bottom: 6px;">
            <div class="item">
                <div class="blog-post">
                <div class="blog-post-image">
                    <div class="image"> <a href="{{ route('posts.withoutCategory.show', $post) }}"><img class="img-thumbnail" src="{{ $post->getFirstImageUrl('medium') }}" alt="" loading="lazy"></a>
                    </div>
                </div>
                <!-- /.blog-post-image -->

                <div class="blog-post-info text-left">
                    <h4 class="name"><a href="{{ route('posts.withoutCategory.show', $post) }}">{{ $post->title }}</a></h4>
                    <span class="info">{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }} </span>
                    <p class="text">{{ str_limit($post->excerpt, 50,'...') }}</p>
                    <a href="{{ route('posts.withoutCategory.show', $post) }}" class="lnk btn btn-primary">Xem thêm</a>
                </div>
                <!-- /.blog-post-info -->

                </div>
                <!-- /.blog-post -->
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
</section>

