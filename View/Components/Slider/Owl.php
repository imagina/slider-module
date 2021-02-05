<?php


namespace Modules\Slider\View\Components\Slider;
use Illuminate\View\Component;

class Owl extends Component
{

    public $id;
    public $layout;
    public $slider;
    public $view;
    public $height;
    public $margin;
    public $loop;
    public $dots;
    public $dotsPosition;
    public $dotsStyle;
    public $nav;
    public $navText;
    public $autoplay;
    public $autoplayHoverPause;
    public $autoplayTimeout;
    public $containerFluid;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $layout = 'slider-owl-layout-1', $height = '500px', $autoplay = true, $margin = 0,
                                $autoplayHoverPause = true, $loop = true, $dots = true, $dotsPosition = 'center',
                                $dotsStyle = 'line', $nav = true, $navText = "", $autoplayTimeout = 5000)
    {
        $this->id = $id;
        $this->layout = $layout ?? 'slider-owl-layout-1';
        $this->height = $height ?? '500px';
        $this->margin = $margin ?? 0;
        $this->dots = $dots ?? true;
        $this->dotsPosition = $dotsPosition ?? 'center';
        $this->dotsStyle = $dotsStyle ?? 'line';
        $this->nav = $nav ?? true;
        $this->navText = json_encode($navText);
        $this->loop = $loop ?? true;
        $this->autoplay = $autoplay ?? true;
        $this->autoplayHoverPause = $autoplayHoverPause ?? true;
        $this->autoplayTimeout = $autoplayTimeout ?? 5000;


        $this->view = "slider::frontend.components.slider.owl.layouts.{$this->layout}.index";

        $this->getItem();
    }

    public function getItem(){
        $params = [
            'filter' => [
                'field' => 'id',
            ],
            'include' => ['slides']
        ];

        $this->slider = app('Modules\\Slider\\Repositories\\SliderApiRepository')->getItem($this->id, json_decode(json_encode($params)));
        if(!$this->slider){
            $params['filter']['field'] = 'system_name';
            $this->slider = app('Modules\\Slider\\Repositories\\SliderApiRepository')->getItem($this->id, json_decode(json_encode($params)));
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view($this->view);
    }
}
