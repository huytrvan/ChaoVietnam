<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Checkbox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $input;
    public $label;
    public $checked;

    public function __construct($input, $label, $checked = false)
    {
        //
        $this->input = $input;
        $this->label = str_replace(' ', '_', $label . ' ' . $input);
        $this->checked = $checked;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.checkbox');
    }
}
