<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     *
     * Create a new component instance.
     *
     * @return void
     */
    public $input;
    public $label;
    public $value;
    public $required;
    public $type;
    public $placeholder;
    public $class;

    public function __construct($input, $label = '', $value = '', $required = false, $type = 'text', $placeholder = '', $class = "")
    {
        //
        $this->input = str_replace(' ', '_', strtolower($input));
        $this->label = !empty($label) ? ucwords($label) : ucwords($input);
        $this->value = $value;
        $this->required = $required;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.input');
    }
}
