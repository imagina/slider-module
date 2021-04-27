<div id="{{ $slider->system_name }}"
     class="owl-carousel owl-theme owl-slider-layout-3 {{ $dots ? ' owl-with-dots carousel-indicators-position-'.$dotsPosition.' carousel-indicators-style-'. $dotsStyle: '' }}">
    @foreach($slider->slides as $index => $slide)
        <div class="card-owl">
            <div class="bg-image">
                @if($slide->mediaFiles()->slideimage->isVideo)
                    <video width="100%" class="d-block h-10 w-100 slider-img__{{$imgObjectFit}}" loop autoplay muted>
                        <source src="{{ $slide->mediaFiles()->slideimage->path }}" />
                    </video>
                @elseif($slide->mediaFiles()->slideimage->isImage)
                    <x-media::single-image :alt="$slide->title ?? Setting::get('core::site-name')"
                                           :title="$slide->title ?? Setting::get('core::site-name')"
                                           :url="$slide->uri ?? $slide->url ?? null" :isMedia="true"
                                           imgClasses="d-block h-100 slider-img__{{$imgObjectFit}}"
                                           width="100%"
                                           :mediaFiles="$slide->mediaFiles()" zone="slideimage"/>
                @else
                    <iframe width="100%" class="full-height" src="{{ $slide->getLinkUrl() }}"
                            frameborder="0" allowfullscreen></iframe>
                @endif
            </div>
            @if(!empty($slide->title) || !empty($slide->caption) || !empty($slide->custom_html))
            <div class="card-owl-body">

                @if(!empty($slide->title))
                    <h3 class="title h1">{{$slide->title}}</h3>
                @endif

                @if(!empty($slide->custom_html))
                    <div class="custom-html">
                        {!! $slide->custom_html !!}
                    </div>
                @endif

                <div class="d-block">
                    <a class="btn btn-primary" href="{{ $slide->url ?? $slide->uri }}">{{ $slide->caption ?? trans('isite::common.menu.viewMore') }}</a>
                </div>

            </div>
            @endif
        </div>
    @endforeach
</div>
@section('scripts-owl')
  @parent
  <script>
    $(document).ready(function () {
    $('#{{ $slider->system_name }}').owlCarousel({
      items: 1,
      dots: {!! $dots ? 'true' : 'false' !!},
      loop: {!! $loop ? 'true' : 'false' !!},
      lazyLoad: true,
      margin: {!! $margin !!},
      nav: {!! $nav ? 'true' : 'false' !!},
      autoplay: {!! $autoplay ? 'true' : 'false' !!},
      autoplayHoverPause: {!! $autoplayHoverPause ? 'true' : 'false' !!},
      responsiveClass: {!! $responsiveClass ? 'true' : 'false' !!},
      responsive: {!! $responsive!!},
      autoplayTimeout: {{$autoplayTimeout}},
      {!! !empty($navText) ? 'navText: '.$navText."," : "" !!}
    });
  });
</script>
@stop
