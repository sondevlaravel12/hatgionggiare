@foreach ($parentCategories as $parentCategory)
@php
    $selectedCategory = false;
    if(isset($category) && !is_null($category->parent) && $category->parent->id==$parentCategory->id)$selectedCategory=true;
@endphp
<div class="accordion-group ">
    <div class="accordion-heading">
        <a href="#{{ $parentCategory->id }}" data-toggle="collapse" class="accordion-toggle {{ $selectedCategory?'':'collapsed' }}">
            {{ $parentCategory->name }}
        </a>
    </div><!-- /.accordion-heading -->
    <div class="accordion-body collapse {{ $selectedCategory?'in':'' }}" id="{{ $parentCategory->id }}" style="{{ $selectedCategory?'':'height: 0px;' }}">
        <div class="accordion-inner">
            <ul>
                @foreach ($parentCategory->children as $child)
                @if ($child->products->count()>0)
                <li ><a style="{{ isset($category) && $category->id==$child->id?'color:#0f6cb2;':'' }}" href="{{ route('categories.products.show', $child) }}">{{ $child->name }} </a></li>
                @endif
                @endforeach

            </ul>
        </div><!-- /.accordion-inner -->
    </div><!-- /.accordion-body -->
</div><!-- /.accordion-group -->
@endforeach
