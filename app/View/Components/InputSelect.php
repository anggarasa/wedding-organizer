<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputSelect extends Component
{
    public $name;
    public $label;
    public $options;
    public $placeholder;
    public $wireModel;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string|null $label
     * @param array $options
     * @param string|null $placeholder
     * @param string|null $wireModel
     */
    public function __construct($name, $label = null, $options = [], $placeholder = null, $wireModel = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->placeholder = $placeholder;
        $this->wireModel = $wireModel;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-select');
    }
}
