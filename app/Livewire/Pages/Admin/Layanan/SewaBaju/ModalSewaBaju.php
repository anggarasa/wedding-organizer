<?php

namespace App\Livewire\Pages\Admin\Layanan\SewaBaju;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Layanan\SewaBaju;
use Illuminate\Http\UploadedFile;
use App\Models\Images\ImageSewaBaju;
use Illuminate\Validation\ValidationException;
use App\Livewire\Pages\Admin\Layanan\SewaBaju\SewaBaju as SewaBajuSewaBaju;

#[Layout('lalyouts.admin-layout')]
class ModalSewaBaju extends Component
{
    use WithFileUploads;
    
    public $name, $category, $ukuran, $price, $status, $images = [], $description;

    // Create Sewa Baju
    public function create()
    {
        try {
            $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'category' => ['required', 'string'],
                'ukuran' => ['required','string'],
                'price' => ['required', 'numeric'],
                'status' => ['required','string'],
                'images' => 'required|array|min:1',
                'images.*' => 'image|mimes:jpg,png,jpeg|max:2048',
                'description' => ['required'],
            ]);

            foreach ($this->images as $image) {
                if (!($image instanceof UploadedFile)) {
                    throw ValidationException::withMessages([
                        'images' => 'Semua file harus berupa gambar yang valid.'
                    ]);
                }
            }

            // Upload Image
            $SewaBaju = SewaBaju::create([
                'name' => $this->name,
                'category' => $this->category,
                'ukuran' => $this->ukuran,
                'price' => $this->price,
                'status' => $this->status,
                'description' => $this->description,
                'slug' => Str::slug($this->name),
            ]);

            // Simpan Image Sewa Baju
            foreach($this->images as $image) {
                $imagePath = $image->storeAs('sewa-baju', $SewaBaju->id.'_'.time().'.'.$image->getClientOriginalExtension(), 'public');

                ImageSewaBaju::create([
                    'sewa_baju_id' => $SewaBaju->id,
                    'image' => $imagePath,
                ]);
            }

            $this->dispatch('sewa-baju')->to(SewaBajuSewaBaju::class);
            $this->resetForm();

            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Baju berhasil di tambahkan.',
                'title' => 'Sukses'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notificationAdmin', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.pages.admin.layanan.sewa-baju.modal-sewa-baju');
    }

    public function resetForm()
    {
        $this->reset(['name', 'category', 'ukuran', 'price', 'status', 'description']);
        $this->images = [];

        $this->dispatch('resetQuillEditor');
        $this->dispatch('resetFileUpload');

        $this->dispatch('close-modal-create-sewa-baju');
    }

    protected $messages = [
        'name.required' => 'Nama baju harus diisi.',
        'name.string' => 'Nama baju harus berupa string.',
        'name.max' => 'Nama baju maksimal 255 karakter.',
        'category.required' => 'Kategori harus diisi.',
        'category.string' => 'Kategori harus berupa string.',
        'ukuran.required' => 'Ukuran harus diisi.',
        'ukuran.string' => 'Ukuran harus berupa string.',
        'price.required' => 'Harga harus diisi.',
        'price.numeric' => 'Harga harus berupa angka.',
        'status.required' => 'Status harus diisi.',
        'status.string' => 'Status harus berupa string.',
        'images.required' => 'Gambar harus diisi.',
        'images.*.image' => 'Gambar harus berupa gambar.',
        'images.*.mimes' => 'Format gambar harus jpg, png, atau jpeg.',
        'images.*.max' => 'Gambar maksimal 2MB.',
        'description.required' => 'Deskripsi harus diisi'
    ];
}
