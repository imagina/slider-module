<div id="{{ $slider->system_name }}" class="carousel slide slider-layout-1"
     data-pause="{{ $pause }}" data-ride="{{ $ride }}" data-interval="{{ $interval }}"
     data-keyboard="{{ $keyboard }}" data-wrap="{{ $wrap }}" data-touch="{{ $touch }}"
     style="height: {{ $height }}">
    @if($dots)
    <ol class="carousel-indicators">
        @foreach($slider->slides as $index => $slide)
            <li data-target="#{{ $slider->system_name }}" data-slide-to="{{ $index }}" class="active"></li>
        @endforeach
    </ol>
    @endif
    <div class="carousel-inner h-100">
        @foreach($slider->slides as $index => $slide)
            <div class="carousel-item @if($index === 0) active @endif h-100">
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
                                    <div class="custom_html d-none d-md-block">
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
    @if($arrows)
        @if(count($slider->slides) > 1)
            <a class="carousel-control-prev" href="#{{$slider->system_name}}" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#{{$slider->system_name}}" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        @endif
    @endif
</div>