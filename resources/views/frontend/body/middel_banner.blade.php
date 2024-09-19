<div class="row">
    @foreach (App\Models\Slider::where('type','=','middle_banner')->orderBy('order', 'ASC')->limit(2)->get() as $banner)

    <div class="col-sm-6">
      <div class="wide-banner cnt-strip">
        <div class="image"> <img class="img-responsive" src="{{$banner->getFirstImageUrl()}}" alt="" loading="lazy">
        </div>
      </div>
      <!-- /.wide-banner -->
    </div>
    @endforeach

</div>
