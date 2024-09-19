<div class="row">
    <div class="col-md-12">
      <div class="wide-banner cnt-strip">
        @if ($bigMiddelbanner = App\Models\Slider::where('type','=','big_middle_banner')->first())
        <div class="image"> <img style="margin: auto" class="img-responsive" src="{{ $bigMiddelbanner->getFirstImageUrl('wider') }}" alt="" loading="lazy">
        </div>
        <div class="strip strip-text">
          <div class="strip-inner">
            <h2 class="text-right">{{ $bigMiddelbanner->big_text }}<br>
              <a href="{{ $bigMiddelbanner->link }}"><span class="shopping-needs">{{ $bigMiddelbanner->call_to_action }}</span></a>
            </h2>
          </div>
        </div>
        <div class="new-label">
          <div class="text">Mới</div>
        </div>
        @endif

        <!-- /.new-label -->
      </div>
      <!-- /.wide-banner -->
    </div>
    <!-- /.col -->

  </div>
