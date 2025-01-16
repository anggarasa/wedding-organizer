<?php

namespace App\Livewire\Pages\Admin\Diskon\DiskonSewaBaju;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Layanan\SewaBaju;
use App\Models\Diskon\DiskonSewaBaju as ModelDiskonSewaBaju;
use App\Livewire\Pages\Admin\Diskon\DiskonSewaBaju\DiskonSewaBaju;

class ModalDiskonSewaBaju extends Component
{
    public $name, $discount, $start_date, $end_date;
    public $selectBajus = [];
    public $selectBajuDetail = [];
    public $dropdownSelect = false;

    public $diskonBajuId, $isEdit = false;

    public function mount()
    {
        $this->updatedSelectedBaju();
    }

    // Create diskon sewa baju
    public function createDiskonSewaBaju()
    {
        try {
            $this->validate([
                'name' => 'required',
                'discount' => 'required|numeric|min:1|max:100',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'selectBajus' => 'required|array|min:1',
            ]);

            $today = now()->format('Y-m-d');
            $status = ($this->start_date < $today && $this->end_date > $today) || ($this->start_date === $today && $this->end_date > $today) ? 'aktif' : ($this->start_date > $today ? 'tidak aktif' : 'kadaluarsa');

            $diskon = ModelDiskonSewaBaju::create([
                'name' => $this->name,
                'discount' => $this->discount,
                'status' => $status,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);

            foreach ($this->selectBajus as $bajuId) {
                $paket = SewaBaju::find($bajuId);
                $paket->discount = $this->discount;  // Memicu mutator
                $paket->diskon_sewa_baju_id = $diskon->id;
                $paket->save();  // Simpan perubahan
            }            

            $this->dispatch('management-diskon-baju')->to(DiskonSewaBaju::class);
            $this->resetInput();

            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Berhasil membuat diskon sewa baju',
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
    // Create diskon sewa baju

    // Edit diskon paket pernikahan
    #[On('editDiskonSewaBaju')]
    public function editDiskonSewaBaju($id)
    {
        $diskon = ModelDiskonSewaBaju::with(['sewaBajus', 'sewaBajus.imageSewaBajus'])->findOrFail($id);

        $this->diskonBajuId = $diskon->id;
        $this->name = $diskon->name;
        $this->discount = $diskon->discount;
        $this->start_date = $diskon->start_date;
        $this->end_date = $diskon->end_date;
        $this->selectBajus = $diskon->sewaBajus->pluck('id')->toArray();
        $this->isEdit = true;
        $this->updatedSelectedBaju();

        $this->dispatch('modal-diskon-baju');
    }

    // Update diskon paket pernikahan
    public function updateDiskonSewaBaju()
    {
        try {
            $this->validate([
                'name' => 'required',
                'discount' => 'required|numeric|min:1|max:100',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'selectBajus' => 'required|array|min:1',
            ]);

            $diskon = ModelDiskonSewaBaju::findOrFail($this->diskonBajuId);
            $today = now()->format('Y-m-d');
            $status = ($this->start_date < $today && $this->end_date > $today) || ($this->start_date === $today && $this->end_date > $today) ? 'aktif' : ($this->start_date > $today ? 'tidak aktif' : 'kadaluarsa');

            $diskon->update([
                'name' => $this->name,
                'discount' => $this->discount,
                'status' => $status,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);

            SewaBaju::where('diskon_sewa_baju_id', $diskon->id)->update([
                'diskon_sewa_baju_id' => null,
                'discount' => null,
            ]);

            foreach ($this->selectBajus as $paketId) {
                $paket = SewaBaju::find($paketId);
                $paket->discount = $this->discount;  // Memicu mutator
                $paket->diskon_sewa_baju_id = $diskon->id;
                $paket->save();  // Simpan perubahan
            }            

            $this->dispatch('management-diskon-baju')->to(DiskonSewaBaju::class);
            $this->resetInput();

            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Berhasil memperbarui diskon sewa baju',
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

    // Input select diskon sewa baju
    public function updatedSelectedBaju()
    {
        $this->selectBajuDetail = SewaBaju::whereIn('id', $this->selectBajus)->get();
    }

    public function toggleKebaya($bajuId)
    {
        // Tambah/hapus kebaya dari daftar pilihan
        if (in_array($bajuId, $this->selectBajus)) {
            $this->selectBajus = array_diff($this->selectBajus, [$bajuId]);
        } else {
            $this->selectBajus[] = $bajuId;
        }

        // Perbarui detail kebaya
        $this->updatedSelectedBaju();
    }
    // Input select diskon sewa baju
    
    public function render()
    {
        return view('livewire.pages.admin.diskon.diskon-sewa-baju.modal-diskon-sewa-baju', [
            'bajus' => SewaBaju::with('imageSewaBajus')->get()
        ]);
    }

    public function resetInput()
    {
        $this->reset(['name', 'discount', 'start_date', 'end_date', 'diskonBajuId']);
        $this->isEdit = false;
        $this->selectBajus = [];
        $this->selectBajuDetail = [];

        $this->dispatch('close-modal-diskon-baju');
    }

    // custom message
    protected $messages = [
        'name.required' => 'Nama diskon sewa baju wajib diisi.',
        'discount.required' => 'Diskon wajib diisi.',
        'discount.numeric' => 'Diskon harus berupa angka.',
        'discount.min' => 'Diskon minimal 1.',
        'discount.max' => 'Diskon maksimal 100.',
        'start_date.required' => 'Tanggal mulai wajib diisi.',
        'end_date.required' => 'Tanggal akhir wajib diisi.',
        'selectBajus.required' => 'Sewa baju wajib dipilih.',
    ];
}
