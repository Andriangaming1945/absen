<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     */
    public $selects;
    public $key;
    public $value;
    public $param;
    public $selected;

    public function __construct($selects, $key, $value, $param, $selected)
    {
        $this->selects = $selects;
        $this->key = $key;
        $this->value = $value;
        $this->param = $param;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
