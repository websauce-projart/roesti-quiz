<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputText extends Component
{
    public $label;
    public $id;
    public $placeholder;
    public $icon;
    public $type;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $id, $placeholder, $icon="", $type="text", $value="")
    {
        $this->label = $label;
        $this->id = $id;
        $this->placeholder = $placeholder;
        $this->icon = $icon;
        $this->type = $type;
        $this->value = $value;
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
