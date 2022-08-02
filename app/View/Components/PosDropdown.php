<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PosDropdown extends Component
{
    public $items;
    public $route;

    public function __construct($items, $route)
    {
        $this->items = $items;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pos-dropdown');
    }
}
