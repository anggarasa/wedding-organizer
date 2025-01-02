<?php

namespace App\Livewire\Pages\Admin\Layanan\SewaBaju;

use Livewire\Component;
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
    public $images = [];
    public $temporaryImages = [];
    public $status, $ukuran, $category, $price, $description;

    public $showFullDescription = false;
    public $descriptionLimit = 500; // Batasan karakter untuk tampilan awal

    public $formattedSize;

    public function mount($slug)
    {
        $this->sewaBaju = SewaBaju::with('imageSewaBajus')->where('slug', $slug)->firstOrFail();
        $this->imageViews = $this->sewaBaju->imageSewaBajus->map(function ($image) {
            return asset('storage/sewa-baju/' . $image->image);
        })->toArray();

        $image = ImageSewaBaju::where('sewa_baju_id', $this->sewaBaju->id)->first();
        if ($image) {
            $imageSizeInBytes = $image->size;
            $this->formattedSize = $this->formatSize($imageSizeInBytes);
        }
    }

    function formatSize($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0); // Pastikan ukuran file tidak negatif
        $power = floor(($bytes ? log($bytes) : 0) / log(1024)); // Tentukan unit yang tepat
        return round($bytes / pow(1024, $power), 2) . ' ' . $units[$power];
    }

    // Detail Dewscription
    public function toggleDescription()
    {
        $this->showFullDescription = !$this->showFullDescription;
    }

    // Management image sewa baju
    public function imagesSelected($files)
    {
        $currentImageCount = count($this->sewaBaju->imageSewaBajus);
        $allowedNewImages = 4 - $currentImageCount;
        
        if (count($files) > $allowedNewImages) {
            $this->dispatch('notificationAdmin', [
                'type' => 'error',
                'message' => "Anda hanya dapat menambahkan {$allowedNewImages} gambar lagi.",
                'title' => 'Error',
            ]);
            return;
        }

        $this->temporaryImages = $files;
    }

    public function cancelUpload()
    {
        $this->temporaryImages = [];
    }

    public function uploadNewImages()
    {
        $currentImageCount = count($this->sewaBaju->imageSewaBajus);
        
        if ($currentImageCount >= 4) {
            $this->dispatch('notificationAdmin', [
                'type' => 'error',
                'message' => 'Maksimal 4 gambar. Hapus beberapa gambar terlebih dahulu.',
                'title' => 'Error',
            ]);
            return;
        }

        foreach ($this->temporaryImages as $index => $image) {
            $imageName = time() . ($index > 0 ? '-' . $index : '') . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('sewa-baju', $imageName, 'public');
            $imageSize = round($image->getSize() / 1024, 2);

            ImageSewaBaju::create([
                'sewa_baju_id' => $this->sewaBaju->id,
                'image' => basename($imagePath),
                'size' => $imageSize,
            ]);
        }

        $this->sewaBaju->refresh();
        $this->imageViews = $this->sewaBaju->imageSewaBajus->map(function ($image) {
            return asset('storage/sewa-baju/' . $image->image);
        })->toArray();
        
        $this->temporaryImages = [];
        $this->dispatch('resetFileInput');
        $this->dispatch('notificationAdmin', [
            'type' => 'success',
            'message' => 'Gambar berhasil diunggah.',
            'title' => 'Sukses',
        ]);
    }

    public function deleteImage($imageId)
    {
        $image = ImageSewaBaju::findOrFail($imageId);
        Storage::delete('sewa-baju/' . $image->image);
        $image->delete();

        $this->sewaBaju->refresh();
        $this->imageViews = $this->sewaBaju->imageSewaBajus->map(function ($image) {
            return asset('storage/sewa-baju/' . $image->image);
        })->toArray();
        
        $this->dispatch('notificationAdmin', [
            'type' => 'success',
            'message' => 'Gambar berhasil dihapus.',
            'title' => 'Sukses',
        ]);
    }
    // Management image sewa baju

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
