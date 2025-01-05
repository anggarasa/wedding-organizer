<?php

namespace App\Livewire\Pages\Admin\Layanan\PaketPernikahan;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Layanan\PaketPernikahan;
use Illuminate\Support\Facades\Storage;

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

    // delete paket pernikahan
    public function delete($id)
    {
        $paket = PaketPernikahan::find($id);

        if ($paket) {
            // Hapus gambar dari storage
            foreach ($paket->imagePaketPernikahans as $image) {
                if (Storage::exists('paket-pernikahan/' . $image->path)) {
                    Storage::delete('paket-pernikahan/' . $image->path);
                }
            }
            // Hapus data image paket pernikahan
            $paket->imagePaketPernikahans()->delete();
            // Hapus data paket pernikahan
            $paket->delete();

            $this->dispatch('close-modal-delete-paket-pernikahan');
            
            // Notification
            $this->dispatch('modal-succsess-delete-paket-pernikahan');
        } else {
            $this->dispatch('notificationAdmin', [
                'type' => 'error',
                'message' => 'Paket pernikahan tidak ditemukan.',
                'title' => 'Gagal',
            ]);
        }
        
    }
    
    public function render()
    {
        return view('livewire.pages.admin.layanan.paket-pernikahan.show-paket-pernikahan');
    }
}
