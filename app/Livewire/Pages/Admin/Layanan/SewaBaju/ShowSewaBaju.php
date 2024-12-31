<?php

namespace App\Livewire\Pages\Admin\Layanan\SewaBaju;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use App\Models\Layanan\SewaBaju;
use App\Models\Images\ImageSewaBaju;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.admin-layout', ['title' => 'Detail Sewa Baju'])]
class ShowSewaBaju extends Component
{
    public $sewaBaju;
    public $status, $ukuran, $category, $price, $images = [], $description;

    public $showFullDescription = false;
    public $descriptionLimit = 500; // Batasan karakter untuk tampilan awal

    public function mount($slug)
    {
        $this->sewaBaju = SewaBaju::with('imageSewaBajus')->where('slug', $slug)->firstOrFail();
    }

    // Detail Dewscription
    public function toggleDescription()
    {
        $this->showFullDescription = !$this->showFullDescription;
    }

    // Edit Sewa Baju
    public function editSewaBaju()
    {
        $this->status = $this->sewaBaju->status;
        $this->ukuran = $this->sewaBaju->ukuran;
        $this->category = $this->sewaBaju->category;
        $this->price = $this->sewaBaju->price;
        $this->description = $this->sewaBaju->description;

        $imageUrls = $this->sewaBaju->imageSewaBajus->map(function ($image) {
            return $image->image ? asset('storage/' . $image->image) : null;
        })->filter()->values();

        $this->dispatch('setOldImages', $imageUrls);

        // Dispatch deskripsi ke Quill Editor
        $this->dispatch('setDescription', $this->description);

        $this->dispatch('modal-edit-sewa-baju');
    }
    // End Edit Sewa Baju

    // Update Sewa Baju
    public function update()
    {
        try {
            $this->validate([
                'category' => ['required', 'string'],
                'ukuran' => ['required','string'],
                'price' => ['required', 'numeric'],
                'status' => ['required','string'],
                'images.*' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
                'description' => ['required'],
            ]);

            // Cari data yang akan diupdate
            $SewaBaju = SewaBaju::findOrFail($this->sewaBaju->id);

            // Persiapkan data untuk update
            $updateData = [
                'category' => $this->category,
                'ukuran' => $this->ukuran,
                'price' => $this->price,
                'status' => $this->status,
                'description' => $this->description,
            ];

            // Update data utama
            $SewaBaju->update($updateData);

            // Proses upload gambar baru jika ada
            if ($this->images) {
                // Hapus gambar lama
                $oldImages = ImageSewaBaju::where('sewa_baju_id', $SewaBaju->id)->get();
                foreach ($oldImages as $oldImage) {
                    // Hapus file dari storage
                    Storage::disk('public')->delete($oldImage->image);
                    // Hapus record dari database
                    $oldImage->delete();
                }

                // Simpan gambar baru
                foreach($this->images as $image) {
                    $imagePath = $image->store('sewa-baju', 'public');

                    ImageSewaBaju::create([
                        'sewa_baju_id' => $SewaBaju->id,
                        'image' => $imagePath,
                    ]);
                }
            }

            $this->resetForm();

            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Baju berhasil diperbarui.',
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
    // End Update Sewa Baju

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
