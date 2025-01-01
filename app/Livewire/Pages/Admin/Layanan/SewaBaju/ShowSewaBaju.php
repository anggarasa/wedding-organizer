<?php

namespace App\Livewire\Pages\Admin\Layanan\SewaBaju;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Layanan\SewaBaju;
use App\Models\Images\ImageSewaBaju;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.admin-layout', ['title' => 'Detail Sewa Baju'])]
class ShowSewaBaju extends Component
{
    use WithFileUploads;
    public $sewaBaju;
    public $imageViews = [];
    public $status, $ukuran, $category, $price, $images = [], $description;

    public $showFullDescription = false;
    public $descriptionLimit = 500; // Batasan karakter untuk tampilan awal

    public function mount($slug)
    {
        $this->sewaBaju = SewaBaju::with('imageSewaBajus')->where('slug', $slug)->firstOrFail();
        $this->imageViews = $this->sewaBaju->imageSewaBajus->map(function ($image) {
            return asset('storage/' . $image->image); // Sesuaikan kolom 'image'
        })->toArray();
    }

    // Detail Dewscription
    public function toggleDescription()
    {
        $this->showFullDescription = !$this->showFullDescription;
    }

    // Update status sewa baju
    public function updateStatus($status)
    {
        $this->sewaBaju->update(['status' => $status]);

        $this->dispatch('notificationAdmin', [
            'type' => 'success',
            'message' => 'Status baju berhasil diubah.',
            'title' => 'Berhasil',
        ]);
    }
    // Update status sewa baju

    // Update category sewa baju
    public function updateCategory($category)
    {
        $this->sewaBaju->update(['category' => $category]);

        $this->dispatch('notificationAdmin', [
            'type' => 'success',
            'message' => 'Kategori baju berhasil diubah.',
            'title' => 'Berhasil',
        ]);
    }
    // Update category sewa baju

    // Update ukuran sewa baju
    public function updateUkuran($ukuran)
    {
        $this->sewaBaju->update(['ukuran' => $ukuran]);

        $this->dispatch('notificationAdmin', [
            'type' => 'success',
            'message' => 'Ukuran baju berhasil diubah.',
            'title' => 'Berhasil',
        ]);
    }
    // Update ukuran sewa baju


    // Hapus Sewa Baju
    public function delete()
    {
        $SewaBaju = SewaBaju::find($this->sewaBaju->id);

        if ($SewaBaju) {
            // Hapus semua media_files dari storage
            foreach ($SewaBaju->imageSewaBajus as $image) {
                if (Storage::exists($image->image)) {
                    Storage::delete($image->image);
                }
            }

            // Hapus produk dan media dari database
            $SewaBaju->imageSewaBajus()->delete(); // Menghapus media terkait
            $SewaBaju->delete(); // Menghapus produk


            $this->resetForm();

            $this->dispatch('modal-succsess-delete-sewa-baju');
        } else {
            $this->dispatch('notificationAdmin', [
                'type' => 'error',
                'message' => 'Gagal menghapus baju.',
                'title' => 'Gagal',
            ]);
        }
    }
    // End Hapus Sewa Baju
    
    public function render()
    {
        return view('livewire.pages.admin.layanan.sewa-baju.show-sewa-baju');
    }

    public function resetForm()
    {
        $this->reset(['status', 'ukuran', 'category', 'price', 'description']);
        $this->images = [];

        $this->dispatch('resetQuillEditor');
        $this->dispatch('resetFileUpload');

        $this->dispatch('close-modal-edit-sewa-baju');
        $this->dispatch('close-modal-delete-sewa-baju');
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
