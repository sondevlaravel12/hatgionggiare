<div class="sidebar-module-container">
    <!-- ==============================================CATEGORY============================================== -->
    <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
        <h3 class="section-title">Danh Mục</h3>
        @php
            $categoriesInSidebar = App\Models\Pcategory::orderBy('order', 'asc')->get();
        @endphp
        @include('frontend.post.__sidebar_categorymenu_op1')
    </div>
    <!-- ============================================== CATEGORY : END ============================================== -->
    <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
        <h3 class="section-title">tab widget</h3>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#popular" data-toggle="tab">bài viết phổ biến</a></li>
            <li><a href="#recent" data-toggle="tab">bài viết mới nhất</a></li>
        </ul>
        <div class="tab-content" style="padding-left:0">
            <div class="tab-pane active m-t-20" id="popular">
                @foreach ($populerPosts as $populerPost)

                <div class="blog-post inner-bottom-30 " >
                    <img class="img-responsive" src="assets/images/blog-post/blog_big_01.jpg" alt="">
                    <h4><a href="blog-details.html">{{ $populerPost->title }}</a></h4>
                        <span class="review">6 Comments</span>
                    <span class="date-time">{{ $populerPost->created_at ? \Carbon\Carbon::parse($populerPost->created_at)->diffForHumans() : '' }}</span>
                    <p>{{ $populerPost->excerpt?$populerPost->excerpt:'' }}</p>

                </div>
                @endforeach


            </div>

            <div class="tab-pane m-t-20" id="recent">
                @foreach ($recentPosts as $recentPost)

                <div class="blog-post inner-bottom-30" >
                    <img class="img-responsive" src="assets/images/blog-post/blog_big_03.jpg" alt="">
                    <h4><a href="blog-details.html">{{ $recentPost->title }}</a></h4>
                    <span class="review">6 Comments</span>
                    <span class="date-time">{{ $recentPost->created_at ? \Carbon\Carbon::parse($recentPost->created_at)->diffForHumans() : '' }}</span>
                    <p>{{ $recentPost->excerpt?$recentPost->excerpt:'' }}</p>

                </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- ============================================== PRODUCT TAGS ============================================== -->
    <div class="sidebar-widget product-tag wow fadeInUp">
        <h3 class="section-title">Post Tags</h3>
        <div class="sidebar-widget-body outer-top-xs">
            <div class="tag-list">
                @foreach ($postTags as $postTag)
                <a class="item
                @if (!isset($tag))
                    active
                @elseif (isset($tag)&&$postTag->id==$tag->id)
                    active
                @endif
                " title="Vest" href="{{ route('tags.posts.show', ['tag'=>$postTag]) }}">{{ $postTag->name }}</a>
                @endforeach

            </div><!-- /.tag-list -->
        </div><!-- /.sidebar-widget-body -->
    </div><!-- /.sidebar-widget -->
    <!-- ============================================== PRODUCT TAGS : END ============================================== -->
</div>
