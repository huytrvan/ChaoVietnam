<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PageHeader extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $label;

    public function __construct($label)
    {
        //
        $this->label = ucwords($label);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.page-header');
    }
}
