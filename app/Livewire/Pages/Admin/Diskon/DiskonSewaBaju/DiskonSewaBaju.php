<?php

namespace App\Livewire\Pages\Admin\Diskon\DiskonSewaBaju;

use App\Models\Diskon\DiskonSewaBaju as DiskonDiskonSewaBaju;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.admin-layout', ['title' => 'Management Diskon Sewa Baju'])]
#[On('management-diskon-baju')]
class DiskonSewaBaju extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.diskon.diskon-sewa-baju.diskon-sewa-baju', [
            'diskonSewaBajus' => DiskonDiskonSewaBaju::with('sewaBajus')->latest()->get()
        ]);
    }
}
