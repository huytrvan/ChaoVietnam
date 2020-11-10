<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SubmitButton extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $label;
    public $color;
    public $class;

    public function __construct($label, $color, $class)
    {
        //
        $this->label = ucwords($label);
        $this->color = $color;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.submit-button');
    }
}
