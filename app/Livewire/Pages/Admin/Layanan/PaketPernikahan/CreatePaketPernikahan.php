<?php

namespace App\Livewire\Pages\Admin\Layanan\PaketPernikahan;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Layanan\SewaBaju;
use App\Models\Layanan\PaketPernikahan;
use App\Models\Images\ImagePaketPernikahan;
use Illuminate\Validation\ValidationException;

#[Layout('layouts.admin-layout', ['title' => 'Management Paket Pernikahan'])]
class CreatePaketPernikahan extends Component
{
    use WithFileUploads;

    public $name, $price, $include, $layananTambahan, $description;
    public $images = [];
    public $sewaBajus = [];
    public $syarat = '<ol><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><span style="background-color: rgb(255, 255, 255);">Make up pengantin (HD Premium)</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><span style="background-color: rgb(255, 255, 255);">Touch up 3x selama acara</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><span style="background-color: rgb(255, 255, 255);">Hair do premium dengan hair piece</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><span style="background-color: rgb(255, 255, 255);">Make up dan hair do untuk 2 anggota keluarga</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><span style="background-color: rgb(255, 255, 255);">Make up dan hair do untuk 2 bridesmaid</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><span style="background-color: rgb(255, 255, 255);">Free konsultasi sebelum hari H</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><span style="background-color: rgb(255, 255, 255);">Free trial make up</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><span style="background-color: rgb(255, 255, 255);">Pemasangan bulu mata premium</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><span style="background-color: rgb(255, 255, 255);">Perawatan kulit dasar sebelum makeup</span></li></ol><p><br></p>';

    public $paketPernikahanId;
    public $isEdit = false;

    public $selectedKebaya = []; // Array ID kebaya yang dipilih
    public $selectedKebayaDetails = []; // Detail data kebaya
    public $dropdownSelect = false;
    public $kebaya;

    public function mount()
    {
        // Initialize selected kebaya
        $this->updatedSelectedKebaya();
    }

    // Create paket pernikahan
    public function createPaketPernikahan()
    {
        try {
            $this->validate([
                'name' => 'required|string|max:255',
                'description' => 'required',
                'price' => 'required|numeric',
                'include' => 'required',
                'layananTambahan' => 'nullable',
                'syarat' => 'required',
                'images.*' => 'required|image|mimes:png,jpg,jpeg|max:2024',
                'selectedKebaya' => 'nullable|array',
                'selectedKebaya.*' => 'exists:sewa_bajus,id',
            ]);

            // Cek nama paket pernikahan
            $slug = Str::slug($this->name);
            $existingSewaBaju = PaketPernikahan::where('slug', $slug)->first();

            if ($existingSewaBaju) {
                throw ValidationException::withMessages([
                    'name' => 'Nama baju sudah digunakan, silakan gunakan nama lain.',
                ]);
            }

            $paketPernikahan = PaketPernikahan::create([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'include' => $this->include,
                'layanan_tambahan' => $this->layananTambahan,
                'syarat' => $this->syarat,
                'slug' => $slug,
            ]);

            // Simpan sewa bajus
            if ($this->selectedKebaya) {
                $paketPernikahan->sewaBajus()->attach($this->selectedKebaya);
            }

            // Simpan gambar ke storage
            foreach ($this->images as $index => $image) {
                // Nama file gambar
                $imageName = time() . ($index > 0 ? '-' . $index : '') . '.' . $image->getClientOriginalExtension();
                
                // Simpan gambar ke storage
                $imagesPath = $image->storeAs('paket-pernikahan', $imageName, 'public');

                ImagePaketPernikahan::create([
                    'paket_pernikahan_id' => $paketPernikahan->id,
                    'path' => $imagesPath,
                ]);
            }

            // Kirim data realtime ke halaman management paket pernikahan
            $this->dispatch('paketPernikahanStored');

            $this->dispatch('modal-success-create-paket-pernikahan');
        } catch (\Exception $e) {
            $this->dispatch('notificationAdmin', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }
    // Create paket pernikahan
    
    // Select kebaya sewa baju
    public function updatedSelectedKebaya()
    {
        // Ambil detail semua kebaya berdasarkan ID
        $this->selectedKebayaDetails = SewaBaju::whereIn('id', $this->selectedKebaya)->get();
    }

    public function toggleKebaya($kebayaId)
    {
        if (in_array($kebayaId, $this->selectedKebaya)) {
            $this->selectedKebaya = array_diff($this->selectedKebaya, [$kebayaId]);
        } else {
            $this->selectedKebaya[] = $kebayaId;
        }

        $this->updatedSelectedKebaya();
    }
    // Select kebaya sewa baju
    
    public function render()
    {
        return view('livewire.pages.admin.layanan.paket-pernikahan.create-paket-pernikahan', [
            'kebayaAkad' => SewaBaju::with('imageSewaBajus')->where('category', 'Kebaya Akad')->get(),
            'kebayaResepsi' => SewaBaju::with('imageSewaBajus')->where('category', 'Kebaya Resepsi')->get(),
        ]);
    }

    // Reset form
    public function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->include = '';
        $this->layananTambahan = '';
        $this->syarat = '';
        $this->images = [];
        $this->sewaBajus = [];
        $this->isEdit = false;

        $this->redirect(route('admin.layanan.paket-pernikahan.management'));
    }

    // Messages custom validation
    protected $messages = [
        'name.required' => 'Nama paket pernikahan tidak boleh kosong',
        'description.required' => 'Deskripsi paket pernikahan tidak boleh kosong',
        'price.required' => 'Harga paket pernikahan tidak boleh kosong',
        'price.numeric' => 'Harga paket pernikahan harus berupa angka',
        'include.required' => 'Include paket pernikahan tidak boleh kosong',
        'syarat.required' => 'Syarat paket pernikahan tidak boleh kosong',
        'images.*.required' => 'Gambar paket pernikahan tidak boleh kosong',
        'images.*.image' => 'Gambar paket pernikahan harus berupa gambar',
        'images.*.mimes' => 'Gambar paket pernikahan harus berformat png, jpg, jpeg',
        'images.*.max' => 'Gambar paket pernikahan maksimal 2MB',
        'selectedKebaya.array' => 'Pilih baju akad & resepsi harus berupa array',
        'selectedKebaya.*.exists' => 'Baju yang dipilih tidak ditemukan',
    ];
}
