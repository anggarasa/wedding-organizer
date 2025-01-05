<?php

namespace App\Livewire\Pages\Admin\Layanan\PaketPernikahan;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use App\Models\Layanan\SewaBaju;
use App\Models\Layanan\PaketPernikahan;

#[Layout('layouts.admin', ['title' => 'Paket Pernikahan'])]
class ModalShowAddBajuPaketPernikahan extends Component
{
    public $dresses = [
        'akad' => [],
        'resepsi' => []
    ];
    public $paketPernikahanId;

    public $selectedDress;

    #[On('addAkad')]
    public function addAkad($id)
    {
        $this->paketPernikahanId = $id;
        $this->loadDresses();

        $this->dispatch('modal-add-akad-paket');
    }
    
    #[On('addResepsi')]
    public function addResepsi($id)
    {
        $this->paketPernikahanId = $id;
        $this->loadDresses();

        $this->dispatch('modal-add-resepsi-paket');
    }

    public function loadDresses()
    {
        $this->dresses['akad'] = SewaBaju::with('imageSewaBajus')->where('category', 'Kebaya Akad')->get();
        $this->dresses['resepsi'] = SewaBaju::with('imageSewaBajus')->where('category', 'Kebaya Resepsi')->get();
    }

    public function submit()
    {
        try {
            if (!$this->selectedDress) {
                $this->dispatch('notificationAdmin', [
                    'type' => 'error',
                    'message' => 'Pilih baju yang akan ditambahkan ke paket pernikahan!',
                    'title' => 'Gagal!',
                ]);
                return;
            }
    
            // Simpan logika pengolahan data di sini, misalnya menyimpan data ke database
            $paket = PaketPernikahan::find($this->paketPernikahanId);
    
            if ($paket) {
                $paket->sewaBajus()->attach($this->selectedDress);
            }

            // Kirim data
            $this->dispatch('management-dress')->to(ShowPaketPernikahan::class);
            // close modal
            $this->dispatch('close-modal-add-akad-paket');
            $this->dispatch('close-modal-add-resepsi-paket');
            
            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => "Dress {$this->selectedDress} berhasil dipilih!",
                'title' => 'Sukses!',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notificationAdmin', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal!',
            ]);
        }
    }
    
    public function render()
    {
        return view('livewire.pages.admin.layanan.paket-pernikahan.modal-show-add-baju-paket-pernikahan');
    }
}
