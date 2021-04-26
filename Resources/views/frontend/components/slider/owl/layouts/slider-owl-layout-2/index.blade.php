<div id="{{ $slider->system_name }}"
     style="max-height: {{ $height }}"
     class="owl-carousel slider-component owl-theme owl-slider-layout-2 {{ $dots ? ' owl-with-dots carousel-indicators-position-'.$dotsPosition.' carousel-indicators-style-'. $dotsStyle: '' }}">
    @foreach($slider->slides as $index => $slide)
        <div class="card border-0">
            <div class="row no-gutters">
                <div class="col-lg-6 ">
                    <div class="h-100 position-relative">
                        @if($slide->mediaFiles()->slideimage->isVideo)
                            <video style="min-height: {{ $height }};max-height: {{ $height }}" class="d-block h-100 slider-img__{{$imgObjectFit}}" width="100%" loop autoplay muted>
                                <source src="{{ $slide->mediaFiles()->slideimage->path }}" />
                            </video>
                        @elseif($slide->mediaFiles()->slideimage->isImage)
                            <x-media::single-image :alt="$slide->title ?? Setting::get('core::site-name')"
                                                   :title="$slide->title ?? Setting::get('core::site-name')"
                                                   :url="$slide->uri ?? $slide->url ?? null" :isMedia="true"
                                                   imgClasses="d-block h-100 slider-img__{{$imgObjectFit}}"
                                                   width="100%"
                                                   imgStyles="min-height: {{ $height }};max-height: {{ $height }}"
                                                   :mediaFiles="$slide->mediaFiles()" zone="slideimage"/>
                        @else
                            <iframe class="full-height" width="100%" height="{{$height}}" src="{{ $slide->getLinkUrl() }}"
                                    frameborder="0" allowfullscreen></iframe>
                        @endif
                    </div>
                </div>

                <div class="col-lg-6 ">

                    <div class="card-body py-5 cover-image">
                        <div class="row align-items-center">
                            <div class="col-xl-8">

                                @if(!empty($slide->title) || !empty($slide->caption) || !empty($slide->custom_html))


                                    @if(!empty($slide->title))
                                        <h3 class="title h1">{{$slide->title}}</h3>
                                    @endif

                                    @if(!empty($slide->custom_html))
                                        <div class="custom-html">
                                            {!! $slide->custom_html !!}
                                        </div>
                                    @endif

                                    <div class="d-block">
                                        <a class="btn btn-primary"
                                           href="{{ $slide->url ?? $slide->uri }}">{{ $slide->caption ?? trans('isite::common.menu.viewMore') }}</a>
                                    </div>


                                @endif

                            </div>
                        </div>
                    </div>

                </div>

            </div>
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
