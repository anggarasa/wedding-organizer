<?php

namespace App\Livewire\Pages\Admin\Layanan\PaketPernikahan;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.admin-layout', ['title' => 'Management Paket Pernikahan'])]
#[On('paketPernikahanStored')]
class PaketPernikahan extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.layanan.paket-pernikahan.paket-pernikahan');
    }
}
