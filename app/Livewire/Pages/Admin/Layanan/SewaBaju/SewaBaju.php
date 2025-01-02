<?php

namespace App\Livewire\Pages\Admin\Layanan\SewaBaju;

use App\Models\Layanan\SewaBaju as LayananSewaBaju;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin-layout', ['title' => 'Management Sewa Baju'])]
#[On('sewa-baju')]
class SewaBaju extends Component
{
    use WithPagination;
    
    // Edit Sewa Baju
    public function editSewaBaju($id)
    {
        $this->dispatch('editSewaBaju', $id)->to(ModalSewaBaju::class);
    }
    // End Edit Sewa Baju

    // Hapus Sewa Baju
    public function hapusSewaBaju($id)
    {
        $this->dispatch('hapusSewaBaju', $id)->to(ModalSewaBaju::class);
    }
    // End Hapus Sewa Baju

    // Update Status Sewa Baju
    public function updateStatusSewaBaju($id, $staus)
    {
        try {
            $sewaBaju = LayananSewaBaju::find($id);
            $sewaBaju->update([
                'status' => $staus
            ]);

            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Status Sewa Baju berhasil diubah!',
                'title' => 'Sukses!',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notificationAdmin', [
                'type' => 'error',
                'message' => 'Status Sewa Baju gagal diubah!',
                'title' => 'Gagal!',
            ]);
        }
    }
    // End Update Status Sewa Baju

    public function render()
    {
        return view('livewire.pages.admin.layanan.sewa-baju.sewa-baju', [
            'sewaBaju' => LayananSewaBaju::with('imageSewaBajus')->latest()->paginate(5)
        ]);
    }
}
