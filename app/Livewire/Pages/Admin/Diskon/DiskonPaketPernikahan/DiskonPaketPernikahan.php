<?php

namespace App\Livewire\Pages\Admin\Diskon\DiskonPaketPernikahan;

use App\Models\Diskon\DiskonPaketPernikahan as DiskonDiskonPaketPernikahan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin-layout', ['title' => 'Management Diskon Paket'])]
#[On('management-diskon-paket')]
class DiskonPaketPernikahan extends Component
{
    use WithPagination;
    
    public function editDiskonPaket($id)
    {
        $this->dispatch('editDiskonPaket', $id)->to(ModalDiskonPaketPernikahan::class);
    }

    // hapus diskon paket pernikahan
    public function deleteDiskonPaket($id)
    {
        try {
            $diskonPaket = DiskonDiskonPaketPernikahan::find($id);

            $diskonPaket->paketPernikahans()->update([
                'diskon_paket_pernikahan_id' => null,
                'discount' => null,
                'final_price' => null,
            ]);
            $diskonPaket->delete();

            $this->dispatch('close-modal-delete-diskon-paket');

            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Berhasil menghapus diskon paket',
                'title' => 'Suskses',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notificationAdmin', [
                'type' => 'error',
                'message' => 'Gagal menghapus diskon paket',
                'title' => 'Gagal',
            ]);
        }
    }
    // hapus diskon paket pernikahan
    
    public function render()
    {
        return view('livewire.pages.admin.diskon.diskon-paket-pernikahan.diskon-paket-pernikahan', [
            'diskonPakets' => DiskonDiskonPaketPernikahan::with(['paketPernikahans', 'paketPernikahans.imagePaketPernikahans'])->latest()->paginate(5),
            'diskonAktif' => DiskonDiskonPaketPernikahan::where('status', 'aktif')->count(),
            'diskonTidakAktif' => DiskonDiskonPaketPernikahan::where('status', 'tidak aktif')->count(),
            'diskonKadaluarsa' => DiskonDiskonPaketPernikahan::where('status', 'kadaluarsa')->count()
        ]);
    }
}
