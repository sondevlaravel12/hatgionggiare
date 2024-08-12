<style>
    .list-group a.list-group-item{
        border: 0 none;
    }
</style>
<div class="list-group">
    @foreach ($categoriesInSidebar as $parentCategory)
        @if ($parentCategory->allPosts()->count()>0)
            <a class="list-group-item {{isset($category)&& $category->id==$parentCategory->id?'active':'' }}" href="{{ route('pcategories.show',$parentCategory->slug ) }}">{{ $parentCategory->name }} </a>
        @endif
    @endforeach
    {{-- @foreach ($categoriesInSidebar as $parentCategory) --}}
    {{-- @php
        $selectedCategory = false;
        if(isset($category) && !is_null($category->parent) && $category->parent->id==$parentCategory->id)$selectedCategory=true;
    @endphp
    <a href="{{ route('posts.category.index', $parentCategory) }}" class="list-group-item {{ isset($category) && $category->id==$parentCategory->id?'active':'' }}">{{ $parentCategory->name }}</a>
    @endforeach --}}
</div>
