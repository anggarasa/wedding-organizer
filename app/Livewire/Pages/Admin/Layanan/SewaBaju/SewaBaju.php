<?php

namespace App\Livewire\Pages\Admin\Layanan\SewaBaju;

use App\Models\Layanan\SewaBaju as LayananSewaBaju;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.admin-layout', ['title' => 'Management Sewa Baju'])]
#[On('sewa-baju')]
class SewaBaju extends Component
{
    public function editSewaBaju($id)
    {
        $this->dispatch('editSewaBaju', $id)->to(ModalSewaBaju::class);
    }

    public function render()
    {
        return view('livewire.pages.admin.layanan.sewa-baju.sewa-baju', [
            'sewaBaju' => LayananSewaBaju::with('imageSewaBajus')->latest()->get()
        ]);
    }
}
