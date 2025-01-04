<?php

namespace App\Livewire\Pages\Admin\Layanan\PaketPernikahan;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use App\Models\Layanan\PaketPernikahan as LayananPaket;

#[Layout('layouts.admin-layout', ['title' => 'Management Paket Pernikahan'])]
class PaketPernikahan extends Component
{
    public $includes;
    public $paketPernikahanId;

    public function mount()
    {
        // Sesuaikan query ini dengan struktur database Anda
        $this->includes = LayananPaket::all();
    }

    // Delete paket pernikahan
    public function deletePaketPernikahan($id)
    {
        $paketPernikahan = LayananPaket::find($id);
        
        if ($paketPernikahan) {
            // Hapus gambar dari storage
            foreach ($paketPernikahan->imagePaketPernikahans as $image) {
                if (Storage::exists('paket-pernikahan/' . $image->path)) {
                    Storage::delete('paket-pernikahan/' . $image->path);
                }
            }
            // Hapus data image paket pernikahan
            $paketPernikahan->imagePaketPernikahans()->delete();
            // Hapus data paket pernikahan
            $paketPernikahan->delete();
            
            // Notification
            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Paket pernikahan berhasil dihapus.',
                'title' => 'Sukses',
            ]);
        } else {
            $this->dispatch('notificationAdmin', [
                'type' => 'error',
                'message' => 'Paket pernikahan tidak ditemukan.',
                'title' => 'Gagal',
            ]);
        }
    }
    // Delete paket pernikahan

    public function render()
    {
        return view('livewire.pages.admin.layanan.paket-pernikahan.paket-pernikahan', [
            'paketPernikahans' => LayananPaket::with('imagePaketPernikahans')->latest()->get()
        ]);
    }
}
