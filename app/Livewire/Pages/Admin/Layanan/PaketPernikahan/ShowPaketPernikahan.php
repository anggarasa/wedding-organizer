<?php

namespace App\Livewire\Pages\Admin\Layanan\PaketPernikahan;

use Livewire\Component;
use App\Models\Layanan\PaketPernikahan;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin-layout', ['title' => 'Detail Paket Pernikahan'])]
class ShowPaketPernikahan extends Component
{
    public $paket;
    public $includes;
    public $syarats;

    public function mount($slug)
    {
        $this->paket = PaketPernikahan::with('imagePaketPernikahans')->where('slug', $slug)->firstOrFail();
        $this->includes = PaketPernikahan::all();
        $this->syarats = PaketPernikahan::all();
    }
    
    public function render()
    {
        return view('livewire.pages.admin.layanan.paket-pernikahan.show-paket-pernikahan');
    }
}
