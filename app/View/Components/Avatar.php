<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Avatar extends Component
{
    public $posePath;
    public $eyePath;
    public $mouthPath;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($posePath, $eyePath, $mouthPath)
    {
        $this->posePath = $posePath;
        $this->eyePath = $eyePath;
        $this->mouthPath = $mouthPath;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.avatar');
    }
}
