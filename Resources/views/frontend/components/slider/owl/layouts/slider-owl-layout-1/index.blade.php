<div id="{{ $slider->system_name }}" class="owl-carousel slider-component owl-theme owl-slider-layout-1{{ $dots ? ' owl-with-dots carousel-indicators-position-'.$dotsPosition.' carousel-indicators-style-'. $dotsStyle: '' }}" style="height: {{ $height }}">
    @foreach($slider->slides as $index => $slide)
        <div class="item h-100">
            <x-media::single-image :alt="$slide->title ?? Setting::get('core::site-name')"
                                   :title="$slide->title ?? Setting::get('core::site-name')"
                                   :url="$slide->uri ?? null" :isMedia="true"
                                   imgClasses="d-block h-100 position-absolute slider-img"
                                   width="100%"
                                   :mediaFiles="$slide->mediaFiles()" zone="slideimage" />
            @if(!empty($slide->title) || !empty($slide->caption) || !empty($slide->custom_html))
            <div class="carousel-caption px-o pb-0 d-none d-md-block h-100">
                <div class="container h-100">
                    <div class="row h-100 justify-content-center">
                        <div class="col-10 text-center">

                            @if(!empty($slide->title))
                                <h1 class="title1 mb-2 h1"><b>{{$slide->title}}</b></h1>
                            @endif

                            @if(!empty($slide->custom_html))
                                <div class="custom-html d-none d-md-block">
                                    {!! $slide->custom_html !!}
                                </div>
                            @endif

                            <div class="d-block">
                                <a class="btn btn-primary" href="{{ $slide->url ?? $slide->uri }}">{{ $slide->caption ?? trans('isite::common.menu.viewMore') }}</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    @endforeach
</div>
<script>
  $(function(){
    $('#{{ $slider->system_name }}').owlCarousel({
      items: 1,
      dots: {{ $dots }},
      loop: {{ $loop ?? 'true' }},
      margin: {{ $margin }},
      nav: {{ $nav }},
      autoPlay: {{ $autoplay }},
      autoplayHoverPause: {{ $autoplayHoverPause }},
      autoplayTimeout: {{ $autoplayTimeout }},
      navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    });
  });
</script>
