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

            if ($diskon) {
                // Reset discount dan final_price di tabel SewaBaju
                foreach ($diskon->sewaBajus as $baju) {
                    $baju->update([
                        'discount' => null,
                        'final_price' => null,
                        'diskon_sewa_baju_id' => null, // Hapus relasi diskon
                    ]);
                }

                // Hapus diskon
                $diskon->delete();

                // Tutup modal delete
                $this->dispatch('close-modal-delete-diskon-baju');

                // Notifikasi sukses
                $this->dispatch('notificationAdmin', [
                    'type' => 'success',
                    'message' => 'Berhasil menghapus diskon sewa baju dan menghapus pengaruhnya di produk.',
                    'title' => 'Sukses'
                ]);
            } else {
                // Notifikasi jika diskon tidak ditemukan
                $this->dispatch('notificationAdmin', [
                    'type' => 'error',
                    'message' => 'Diskon tidak ditemukan.',
                    'title' => 'Gagal'
                ]);
            }
        } catch (\Exception $e) {
            // Notifikasi error
            $this->dispatch('notificationAdmin', [
                'type' => 'error',
                'message' => 'Gagal menghapus diskon sewa baju.',
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
