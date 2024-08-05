<style>

    #category_head_menu li.active a,
    #category_head_menu li a:hover,
    #category_head_menu li.active a:focus,
    #category_head_menu li.active a:hover{
      color:#ac1b05 !important;
    }
</style>
<nav class="nav nav-tabs nav-tab-line pull-left hidden-xs" id="category_head_menu">
    <div class="container-fluid">
      <ul class="nav navbar-nav ">
        @php
            $categoriesInTab = App\Models\Category::whereNotNull('in_infor_tab')->get();
        @endphp
        @if (Route::is('products.index'))
            <li class="active" ><a href="{{ route('products.index') }}">Tat ca san pham</a></li>
            @foreach ($categoriesInTab as $cat)
            <li class=""><a href="{{ route('products.category.index',$cat) }}">{{ $cat->name }}</a></li>
            @endforeach

        @else
            <li class="" ><a href="{{ route('products.index') }}">Tat ca san pham</a></li>
            @foreach ($categoriesInTab as $cat)
            <li class="{{isset($category) && $cat->id==$category->id?'active':'' }}"><a href="{{ route('products.category.index',$cat) }}">{{ $cat->name }}</a></li>
            @endforeach

        @endif

      </ul>
    </div>
</nav>
