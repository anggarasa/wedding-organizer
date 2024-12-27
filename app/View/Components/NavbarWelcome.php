<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavbarWelcome extends Component
{
    public $logo;
    public $menuItems;

    /**
     * Create a new component instance.
     */
    public function __construct($logo = null, $menuItems = null)
    {
        $this->logo = $logo;
        $this->menuItems = $menuItems;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar.navbar-welcome');
    }
}
