<?php

namespace App\Livewire\Pages\Admin\Diskon\DiskonPaketPernikahan;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Layanan\PaketPernikahan;
use App\Models\Diskon\DiskonPaketPernikahan as ModelDiskonPaket;
use App\Livewire\Pages\Admin\Diskon\DiskonPaketPernikahan\DiskonPaketPernikahan;
use Livewire\Attributes\On;

#[Layout('layouts.admin-layout')]
class ModalDiskonPaketPernikahan extends Component
{
    public $name, $discount, $start_date, $end_date;
    public $selectPakets = [];
    public $selectPaketDetail = [];
    public $dropdownSelect = false;

    public $diskonPaketId, $isEdit = false;

    public function mount()
    {
        $this->updatedSelectedPaket();
    }

    // Create diskon Paket
    public function createDiskonPaket()
    {
        try {
            $this->validate([
                'name' => 'required',
                'discount' => 'required|numeric|min:1|max:100',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'selectPakets' => 'required|array|min:1',
            ]);

            $today = now()->format('Y-m-d');
            $status = $this->start_date < $today ? 'aktif' : ($this->start_date === $today ? 'aktif' : 'tidak aktif');

            $diskon = ModelDiskonPaket::create([
                'name' => $this->name,
                'discount' => $this->discount,
                'status' => $status,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);

            foreach ($this->selectPakets as $paketId) {
                PaketPernikahan::where('id', $paketId)->update([
                    'diskon_paket_pernikahan_id' => $diskon->id,
                    'discount' => $this->discount,
                ]);
            }

            $this->dispatch('management-diskon-paket')->to(DiskonPaketPernikahan::class);
            $this->resetInput();

            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Berhasil membuat diskon paket pernikahan',
                'title' => 'Sukses',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notificationAdmin', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }
    // Create diskon Paket

    // Select kebaya sewa baju
    public function updatedSelectedPaket()
    {
        // Ambil detail semua kebaya berdasarkan ID yang dipilih
        $this->selectPaketDetail = PaketPernikahan::whereIn('id', $this->selectPakets)->get();
    }

    public function toggleKebaya($paketId)
    {
        // Tambah/hapus kebaya dari daftar pilihan
        if (in_array($paketId, $this->selectPakets)) {
            $this->selectPakets = array_diff($this->selectPakets, [$paketId]);
        } else {
            $this->selectPakets[] = $paketId;
        }

        // Perbarui detail kebaya
        $this->updatedSelectedPaket();
    }
    // Select kebaya sewa baju
    
    public function render()
    {
        return view('livewire.pages.admin.diskon.diskon-paket-pernikahan.modal-diskon-paket-pernikahan', [
            'pakets' => PaketPernikahan::with('imagePaketPernikahans')->get()
        ]);
    }

    // Reset input 
    public function resetInput()
    {
        $this->reset(['name', 'discount', 'start_date', 'end_date', 'diskonPaketId']);
        $this->isEdit = false;
        $this->selectPakets = [];
        $this->selectPaketDetail = [];

        $this->dispatch('close-modal-diskon-paket');
    }
}
