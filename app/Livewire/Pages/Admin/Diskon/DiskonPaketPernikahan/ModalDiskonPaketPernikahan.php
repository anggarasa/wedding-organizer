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
            $status = ($this->start_date < $today && $this->end_date > $today) || ($this->start_date === $today && $this->end_date > $today) ? 'aktif' : ($this->start_date > $today ? 'tidak aktif' : 'kadaluarsa');

            $diskon = ModelDiskonPaket::create([
                'name' => $this->name,
                'discount' => $this->discount,
                'status' => $status,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);

            foreach ($this->selectPakets as $paketId) {
                $paket = PaketPernikahan::find($paketId);
                $paket->discount = $this->discount;  // Memicu mutator
                $paket->diskon_paket_pernikahan_id = $diskon->id;
                $paket->save();  // Simpan perubahan
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

    // Edit diskon paket pernikahan
    #[On('editDiskonPaket')]
    public function editDiskonPaket($id)
    {
        $diskon = ModelDiskonPaket::with(['paketPernikahans', 'paketPernikahans.imagePaketPernikahans'])->findOrFail($id);

        $this->diskonPaketId = $diskon->id;
        $this->name = $diskon->name;
        $this->discount = $diskon->discount;
        $this->start_date = $diskon->start_date;
        $this->end_date = $diskon->end_date;
        $this->selectPakets = $diskon->paketPernikahans->pluck('id')->toArray();
        $this->isEdit = true;
        $this->updatedSelectedPaket();

        $this->dispatch('modal-diskon-paket');
    }

    // Update diskon paket pernikahan
    public function updateDiskonPaket()
    {
        try {
            $this->validate([
                'name' => 'required',
                'discount' => 'required|numeric|min:1|max:100',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'selectPakets' => 'required|array|min:1',
            ]);

            $diskon = ModelDiskonPaket::findOrFail($this->diskonPaketId);
            $today = now()->format('Y-m-d');
            $status = ($this->start_date < $today && $this->end_date > $today) || ($this->start_date === $today && $this->end_date > $today) ? 'aktif' : ($this->start_date > $today ? 'tidak aktif' : 'kadaluarsa');

            $diskon->update([
                'name' => $this->name,
                'discount' => $this->discount,
                'status' => $status,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);

            PaketPernikahan::where('diskon_paket_pernikahan_id', $diskon->id)->update([
                'diskon_paket_pernikahan_id' => null,
                'discount' => null,
            ]);

            foreach ($this->selectPakets as $paketId) {
                $paket = PaketPernikahan::find($paketId);
                $paket->discount = $this->discount;  // Memicu mutator
                $paket->diskon_paket_pernikahan_id = $diskon->id;
                $paket->save();  // Simpan perubahan
            }            

            $this->dispatch('management-diskon-paket')->to(DiskonPaketPernikahan::class);
            $this->resetInput();

            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Berhasil memperbarui diskon paket pernikahan',
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

    public function updatedSelectedPaket()
    {
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

    public function render()
    {
        return view('livewire.pages.admin.diskon.diskon-paket-pernikahan.modal-diskon-paket-pernikahan', [
            'pakets' => PaketPernikahan::with('imagePaketPernikahans')->get()
        ]);
    }

    public function resetInput()
    {
        $this->reset(['name', 'discount', 'start_date', 'end_date', 'diskonPaketId']);
        $this->isEdit = false;
        $this->selectPakets = [];
        $this->selectPaketDetail = [];

        $this->dispatch('close-modal-diskon-paket');
    }

    protected $messages = [
        'name.required' => 'Nama diskon paket pernikahan wajib diisi.',
        'discount.required' => 'Diskon wajib diisi.',
        'discount.numeric' => 'Diskon harus berupa angka.',
        'discount.min' => 'Diskon minimal 1.',
        'discount.max' => 'Diskon maksimal 100.',
        'start_date.required' => 'Tanggal mulai wajib diisi.',
        'end_date.required' => 'Tanggal akhir wajib diisi.',
        'selectPakets.required' => 'Paket pernikahan wajib dipilih.',
    ];
}
