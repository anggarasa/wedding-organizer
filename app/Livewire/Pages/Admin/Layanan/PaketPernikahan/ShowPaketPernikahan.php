<?php

namespace App\Livewire\Pages\Admin\Layanan\PaketPernikahan;

use Livewire\Component;
use App\Models\Layanan\PaketPernikahan;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin-layout', ['title' => 'Detail Paket Pernikahan'])]
class ShowPaketPernikahan extends Component
{
    public $paket;
    public $bajusAkad;
    public $bajusResepsi;

    public function mount($slug)
    {
        $this->paket = PaketPernikahan::with(['imagePaketPernikahans', 'sewaBajus.imageSewaBajus'])
        ->where('slug', $slug)
        ->firstOrFail();

        // Filter data akad dan resepsi dari koleksi hasil query
        $this->bajusAkad = $this->paket->sewaBajus->where('category', 'Kebaya Akad');
        $this->bajusResepsi = $this->paket->sewaBajus->where('category', 'Kebaya Resepsi');
    }
    
    public function render()
    {
        return view('livewire.pages.admin.layanan.paket-pernikahan.show-paket-pernikahan');
    }
}
