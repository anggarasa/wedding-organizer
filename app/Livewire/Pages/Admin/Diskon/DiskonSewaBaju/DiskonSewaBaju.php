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

    // Edit Diskon Sewa Baju
    public function editDiskonSewaBaju($id)
    {
        $this->dispatch('editDiskonSewaBaju', $id)->to(ModalDiskonSewaBaju::class);
    }
    // Edit Diskon Sewa Baju

    // Delete diskon sewa baju
    public function deleteDiskonSewaBaju($id)
    {
        try {
            $diskon = DiskonDiskonSewaBaju::find($id);
            $diskon->delete();

            // close modal delete
            $this->dispatch('close-modal-delete-diskon-baju');

            // notification success
            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Berhasil menghapus diskon sewa baju',
                'title' => 'Sukses'
            ]);
        } catch (\Exception $e) {
            // notification error
            $this->dispatch('notificationAdmin', [
                'type' => 'error',
                'message' => 'Gagal menghapus diskon sewa baju',
                'title' => 'Gagal'
            ]);
        }
    }
    // Delete diskon sewa baju
    
    public function render()
    {
        return view('livewire.pages.admin.diskon.diskon-sewa-baju.diskon-sewa-baju', [
            'diskonSewaBajus' => DiskonDiskonSewaBaju::with('sewaBajus')->latest()->get()
        ]);
    }
}
