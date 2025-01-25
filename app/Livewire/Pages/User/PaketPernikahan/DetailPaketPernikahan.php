<?php

namespace App\Livewire\Pages\User\PaketPernikahan;

use App\Models\Layanan\PaketPernikahan;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['title' => 'Detail Paket Pernikahan'])]
class DetailPaketPernikahan extends Component
{
    public $paket;
    public $bajusAkad;
    public $bajusResepsi;

    public function mount($slug)
    {
        $this->paket = PaketPernikahan::with(['imagePaketPernikahans', 'sewaBajus'])->where('slug', $slug)->first();

        // Filter data akad dan resepsi dari koleksi hasil query
        $this->bajusAkad = $this->paket->sewaBajus->where('category', 'Kebaya Akad');
        $this->bajusResepsi = $this->paket->sewaBajus->where('category', 'Kebaya Resepsi');
    }
    
    public function render()
    {
        return view('livewire.pages.user.paket-pernikahan.detail-paket-pernikahan');
    }
}
