<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Notify extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $message;
    public $confirm;

    public function __construct($message, $confirm = 'Got it!')
    {
        //
        $this->message = $message;
        $this->confirm = $confirm;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.notify');
    }
}
