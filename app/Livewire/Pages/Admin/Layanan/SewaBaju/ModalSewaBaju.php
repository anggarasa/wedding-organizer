<?php

namespace App\Livewire\Pages\Admin\Layanan\SewaBaju;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Layanan\SewaBaju;
use App\Models\Images\ImageSewaBaju;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\Livewire\Pages\Admin\Layanan\SewaBaju\SewaBaju as SewaBajuSewaBaju;
use Livewire\Attributes\On;

#[Layout('lalyouts.admin-layout')]
class ModalSewaBaju extends Component
{
    use WithFileUploads;
    
    public $name, $category, $ukuran, $price, $status, $images = [], $description;

    public $SewaBajuId, $isEdit = false;

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
                'images.*' => 'required|image|mimes:jpg,png,jpeg|max:2048',
                'description' => ['required'],
            ]);

            // Upload Image
            $slug = Str::slug($this->name);
            $existingSewaBaju = SewaBaju::where('slug', $slug)->first();

            if ($existingSewaBaju) {
                throw ValidationException::withMessages([
                    'name' => 'Nama baju sudah digunakan, silakan gunakan nama lain.',
                ]);
            }

            $SewaBaju = SewaBaju::create([
                'name' => $this->name,
                'category' => $this->category,
                'ukuran' => $this->ukuran,
                'price' => $this->price,
                'status' => $this->status,
                'description' => $this->description,
                'slug' => $slug,
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
    // End create sewa baju

    // Edit Sewa Baju
    #[On('editSewaBaju')]
    public function editSewaBaju($id)
    {
        $this->resetForm();
        $this->isEdit = true;
        $this->SewaBajuId = $id;
        $SewaBaju = SewaBaju::with('imageSewaBajus')->find($id);
        $this->name = $SewaBaju->name;
        $this->category = $SewaBaju->category;
        $this->ukuran = $SewaBaju->ukuran;
        $this->price = $SewaBaju->price;
        $this->status = $SewaBaju->status;
        // $this->images = $SewaBaju->imageSewaBajus;
        $this->description = $SewaBaju->description;

        $imageUrls = $SewaBaju->imageSewaBajus->map(function ($image) {
            return $image->image ? asset('storage/' . $image->image) : null;
        })->filter()->values();

        $this->dispatch('setOldImages', $imageUrls);

        // Dispatch deskripsi ke Quill Editor
        $this->dispatch('setDescription', $this->description);

        $this->dispatch('modal-create-sewa-baju');
    }
    // End Edit Sewa Baju

    // Update sewa baju
    public function update()
    {
        try {
            $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'category' => ['required', 'string'],
                'ukuran' => ['required','string'],
                'price' => ['required', 'numeric'],
                'status' => ['required','string'],
                'images' => 'nullable|array|max:5',
                'images.*' => 'image|mimes:jpg,png,jpeg|max:2048',
                'description' => ['required'],
            ]);

            // Cari data yang akan diupdate
            $SewaBaju = SewaBaju::findOrFail($this->SewaBajuId);

            // Persiapkan data untuk update
            $updateData = [
                'name' => $this->name,
                'category' => $this->category,
                'ukuran' => $this->ukuran,
                'price' => $this->price,
                'status' => $this->status,
                'description' => $this->description,
            ];

            // Generate slug hanya jika nama berubah
            if ($SewaBaju->name !== $this->name) {
                // Cek apakah slug sudah ada
                $baseSlug = Str::slug($this->name);
                $slug = $baseSlug;
                $counter = 1;

                while (SewaBaju::where('slug', $slug)->where('id', '!=', $SewaBaju->id)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $updateData['slug'] = $slug;
            }

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
                    $imagePath = $image->storeAs('sewa-baju', $SewaBaju->id.'_'.time().'.'.$image->getClientOriginalExtension(), 'public');

                    ImageSewaBaju::create([
                        'sewa_baju_id' => $SewaBaju->id,
                        'image' => $imagePath,
                    ]);
                }
            }

            $this->dispatch('sewa-baju')->to(SewaBajuSewaBaju::class);
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
    // End update sewa baju
    
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
