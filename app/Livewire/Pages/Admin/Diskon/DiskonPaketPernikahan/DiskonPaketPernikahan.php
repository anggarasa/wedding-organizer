<?php

namespace App\Livewire\Pages\Admin\Diskon\DiskonPaketPernikahan;

use App\Models\Diskon\DiskonPaketPernikahan as DiskonDiskonPaketPernikahan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.admin-layout', ['title' => 'Management Diskon Paket'])]
#[On('management-diskon-paket')]
class DiskonPaketPernikahan extends Component
{

    
    public function render()
    {
        return view('livewire.pages.admin.diskon.diskon-paket-pernikahan.diskon-paket-pernikahan', [
            'diskonPakets' => DiskonDiskonPaketPernikahan::with(['paketPernikahans', 'paketPernikahans.imagePaketPernikahans'])->latest()->get()
        ]);
    }
}
