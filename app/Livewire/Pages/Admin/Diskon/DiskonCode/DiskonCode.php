<?php

namespace App\Livewire\Pages\Admin\Diskon\DiskonCode;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use App\Models\Diskon\DiskonCode as DiskonCodeModel;
use App\Livewire\Pages\Admin\Diskon\DiskonCode\ModalDiskonCode;
use Illuminate\Database\Eloquent\Builder;

#[Layout('layouts.admin-layout', ['title' => 'Management Diskon Code'])]
#[On('management-diskon-code')]
class DiskonCode extends Component
{
    public $perPage = 6;
    public $tatalData;

    public function mount()
    {
        $this->tatalData = DiskonCodeModel::count();
    }

    public function loadMore()
    {
        $this->perPage += 6;
    }

    public function editDiskonCode($id)
    {
        $this->dispatch('editDiskonCode', $id)->to(ModalDiskonCode::class);
    }

    // Delete diskon kode
    public function deleteDiskonCode($id)
    {
        try {
            $diskonCode = DiskonCodeModel::find($id);
            $diskonCode->delete();

            $this->dispatch('close-modal-delete-diskon-code');
            
            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Code diskon berhasil dihapus!',
                'title' => 'Sukses'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notificationAdmin', [
                'type' => 'error',
                'message' => 'Gagal menghapus code diskon!',
                'title' => 'Gagal'
            ]);
        }
    }

    // Fitur Search diskon code
    public $searchCode = '';
    public $searchStatus = '';
    // Fitur Search diskon code
    
    public function render()
    {
        $diskonCodes = DiskonCodeModel::when($this->searchCode !== '', function ($query) {
            $query->where(function ($q) {
                $q->where('code', 'like', '%' . $this->searchCode . '%')
                ->orWhere('description', 'like', '%' . $this->searchCode . '%')
                ->orWhere('discount', 'like', '%' . $this->searchCode . '%');
            });
        })
        ->when($this->searchStatus !== '', fn(Builder $query) => $query->where('status', $this->searchStatus))
        ->latest()
        ->take($this->perPage)
        ->get();

        return view('livewire.pages.admin.diskon.diskon-code.diskon-code', compact('diskonCodes'), [
            'diskonAktif' => DiskonCodeModel::where('status', 'aktif')->count(),
            'diskonTidakAktif' => DiskonCodeModel::where('status', 'tidak aktif')->count(),
            'diskonKadaluarsa' => DiskonCodeModel::where('status', 'kadaluarsa')->count()
        ]);
    }
}
