<?php

namespace App\Livewire\Pages\Admin\Layanan\SewaBaju;

use App\Livewire\Pages\Admin\Layanan\SewaBaju\SewaBaju as SewaBajuSewaBaju;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use App\Models\Layanan\SewaBaju;
use Livewire\WithFileUploads;

#[Layout('lalyouts.admin-layout')]
class ModalSewaBaju extends Component
{
    use WithFileUploads;
    
    public $name, $category, $ukuran, $price, $status, $image, $description;

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
                'image' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2000'],
                'description' => ['required'],
            ]);

            // Upload Image
            $image = $this->image->store('sewa-baju', 'public');

            SewaBaju::create([
                'name' => $this->name,
                'category' => $this->category,
                'ukuran' => $this->ukuran,
                'price' => $this->price,
                'status' => $this->status,
                'image' => $image,
                'description' => $this->description,
                'slug' => Str::slug($this->name),
            ]);

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
        $this->reset(['name', 'category', 'ukuran', 'price', 'status', 'image', 'description']);

        $this->dispatch('close-modal-create-sewa-baju');
    }

    protected $message = [
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
        'image.required' => 'Gambar harus diisi.',
        'image.image' => 'Gambar harus berupa gambar.',
        'image.mimes' => 'Format gambar harus jpg, png, atau jpeg.',
        'image.max' => 'Gambar maksimal 2MB.',
    ];
}
