<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RangeInput extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $label;
    public $input;
    public $class;
    public $min;
    public $max;

    public function __construct($label, $input, $class = "", $min, $max)
    {
        //
        $this->label = ucwords($label);
        $this->input = $input;
        $this->class = $class;
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.range-input');
    }
}
