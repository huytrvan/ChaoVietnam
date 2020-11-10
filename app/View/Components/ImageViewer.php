<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ImageViewer extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $post;
    public $images;

    public function __construct($post, $images)
    {
        //
        $this->post = $post;
        $this->images = $images;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.image-viewer');
    }
}
