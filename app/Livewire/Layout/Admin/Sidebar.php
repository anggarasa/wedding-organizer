<?php

namespace App\Livewire\Layout\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin-layout')]
class Sidebar extends Component
{
    public function render()
    {
        return view('livewire.layout.admin.sidebar');
    }
}
