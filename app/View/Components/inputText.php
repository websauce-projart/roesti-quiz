<?php

namespace App\View\Components;

use Illuminate\View\Component;

class inputText extends Component
{

    public $label;
    public $id;
    public $placeholder;
    public $icon;
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $id, $placeholder, $icon="", $type="text")
    {
        $this->label = $label;
        $this->id = $id;
        $this->placeholder = $placeholder;
        $this->icon = $icon;
        $this->type = $type;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-text');
    }
}
