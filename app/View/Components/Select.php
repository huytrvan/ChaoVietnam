<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $input;
    public $label;
    public $options;
    public $class;
    public $selected;
    public $form;
    public $upper;

    public function __construct($input, $label = '', $selected = "", $class = "", $options = [], $form = '', $upper = "")
    {
        //
        $this->input = $input;
        $this->label = ($label === '') ? ucwords($input) : $label;
        $this->options = $options;
        $this->class = $class;
        $this->selected = $selected;
        $this->form = $form !== '' ? $form . '.submit()' : '';
        $this->upper = $upper;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.select');
    }
}
