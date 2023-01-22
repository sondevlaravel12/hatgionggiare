<div class="item">
    <div class="blog-post">
      <div class="blog-post-image">
        <div class="image"> <a href="blog.html"><img src="{{ $post->getFirstImageUrl('large') }}" alt=""></a>
        </div>
      </div>
      <!-- /.blog-post-image -->

      <div class="blog-post-info text-left">
        <h3 class="name"><a href="#">{{ $post->title }}</a></h3>
        <span class="info">By Jone Doe &nbsp;|&nbsp; {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }} </span>
        <p class="text">{{ $post->excerpt }}</p>
        <a href="#" class="lnk btn btn-primary">Xem thêm</a>
      </div>
      <!-- /.blog-post-info -->

    </div>
</div>
