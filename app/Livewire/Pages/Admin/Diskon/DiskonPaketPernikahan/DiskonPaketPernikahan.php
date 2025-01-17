<?php

namespace App\Livewire\Pages\Admin\Diskon\DiskonPaketPernikahan;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Diskon\DiskonPaketPernikahan as DiskonDiskonPaketPernikahan;

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

    // fitur search diskon paket pernikahan
    public $searchDiskon = '';
    public $searchStatus = '';
    // fitur search diskon paket pernikahan
    
    public function render()
    {
        $diskonPakets = DiskonDiskonPaketPernikahan::with(['paketPernikahans', 'paketPernikahans.imagePaketPernikahans'])
        ->when($this->searchDiskon !== '', fn(Builder $query) => $query->where('name', 'like', '%' . $this->searchDiskon . '%'))
        ->when($this->searchDiskon !== '', fn(Builder $query) => $query->orWhere('discount', 'like', '%' . $this->searchDiskon . '%'))
        ->when($this->searchStatus !== '', fn(Builder $query) => $query->where('status', $this->searchStatus))
        ->latest()->paginate(5);;

        return view('livewire.pages.admin.diskon.diskon-paket-pernikahan.diskon-paket-pernikahan', compact('diskonPakets'), [
            'diskonAktif' => DiskonDiskonPaketPernikahan::where('status', 'aktif')->count(),
            'diskonTidakAktif' => DiskonDiskonPaketPernikahan::where('status', 'tidak aktif')->count(),
            'diskonKadaluarsa' => DiskonDiskonPaketPernikahan::where('status', 'kadaluarsa')->count()
        ]);
    }
}
