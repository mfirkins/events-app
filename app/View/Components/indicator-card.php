<?php

namespace App\View\Components;

use Illuminate\View\Component;

class indicator-card extends Component
{
    public $icon;

    public $content;

    public $colour;

    public $header
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render($icon, $content, $colour, $header)
    {
        $this->icon = $icon;
        $this->content = $content;
        $this->colour = $colour;
        $this->header = $header
        return view('components.indicator-card');
    }
}
