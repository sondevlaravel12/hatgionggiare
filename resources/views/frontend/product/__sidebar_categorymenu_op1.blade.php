<style>
    .list-group a.list-group-item{
        border: 0 none;
    }
</style>
<div class="list-group">
    @foreach ($categoriesInSidebar as $parentCategory)
    @php
        $selectedCategory = false;
        if(isset($category) && !is_null($category->parent) && $category->parent->id==$parentCategory->id)$selectedCategory=true;
    @endphp
    <a href="{{ route('products.category.index', $parentCategory) }}" class="list-group-item {{ isset($category) && $category->id==$parentCategory->id?'active':'' }}">{{ $parentCategory->name }}</a>
    @endforeach
</div>
