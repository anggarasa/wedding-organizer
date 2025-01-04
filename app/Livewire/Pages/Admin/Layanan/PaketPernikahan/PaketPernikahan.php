<?php

namespace App\Livewire\Pages\Admin\Layanan\PaketPernikahan;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use App\Models\Layanan\PaketPernikahan as LayananPaket;

#[Layout('layouts.admin-layout', ['title' => 'Management Paket Pernikahan'])]
class PaketPernikahan extends Component
{
    public $includes;

    public function mount()
    {
        // Sesuaikan query ini dengan struktur database Anda
        $this->includes = LayananPaket::all();
    }

    public function render()
    {
        return view('livewire.pages.admin.layanan.paket-pernikahan.paket-pernikahan', [
            'paketPernikahans' => LayananPaket::with('imagePaketPernikahans')->latest()->get()
        ]);
    }
}
