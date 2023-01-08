<?php

namespace App\View\Components;

use Illuminate\View\Component;

class IndicatorCard extends Component
{
    public $icon;

    public $colour;

    public $header;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon, $colour, $header)
    {
        $this->icon = $icon;
        $this->colour = $colour;
        $this->header = $header;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.indicator-card');
    }
}
