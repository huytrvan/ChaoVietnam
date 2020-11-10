<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Post extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $images;
    public $post;
    public $property;
    public $neighborhood;

    public function __construct($images, $post, $property, $neighborhood)
    {
        //
        $this->images = $images;
        $this->post = $post;
        $this->property = empty($property[0]) ? $property : $property[0];
        $this->neighborhood = empty($neighborhood[0]) ? $neighborhood : $neighborhood[0];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.post');
    }
}
