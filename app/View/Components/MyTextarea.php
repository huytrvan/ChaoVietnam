<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MyTextarea extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $input;
    public $label;
    public $value;
    public $rows;
    public $required;

    public function __construct($input, $value = '', $rows = 10, $required = false)
    {
        //
        $this->input = $input;
        $this->label = ucwords($input);
        $this->value = $value;
        $this->rows = $rows;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.my-textarea');
    }
}
