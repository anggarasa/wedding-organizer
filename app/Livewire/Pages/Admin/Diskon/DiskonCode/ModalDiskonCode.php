<?php

namespace App\Livewire\Pages\Admin\Diskon\DiskonCode;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Validation\ValidationException;
use App\Models\Diskon\DiskonCode as DiskonCodeModel;
use App\Livewire\Pages\Admin\Diskon\DiskonCode\DiskonCode;
use Livewire\Attributes\On;

#[Layout('layouts.admin-layout', ['title' => 'Management Diskon Code'])]
class ModalDiskonCode extends Component
{
    public $code, $description, $discount, $start_date, $end_date, $penggunaan;
    public $diskonId, $isEdit = false;

    // create diskon code
    public function createDiskonCode()
    {
        try {
            $this->validate([
                'code' => 'required|string|unique:diskon_codes,code',
                'description' => 'required',
                'discount' => 'required|numeric',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'penggunaan' => 'required|integer',
            ]);
    
            $today = now()->format('Y-m-d');
            $status = $this->start_date < $today ? 'aktif' : ($this->start_date === $today ? 'aktif' : 'tidak aktif');
    
            DiskonCodeModel::create([
                'code' => $this->code,
                'description' => $this->description,
                'discount' => $this->discount,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'penggunaan' => $this->penggunaan,
                'status' => $status,
            ]);
    
            $this->dispatch('management-diskon-code')->to(DiskonCode::class);
            $this->resetInput();
    
            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Diskon code berhasil dibuat',
                'title' => 'Berhasil'
            ]);
        } catch (ValidationException $e) {
            $this->dispatch('notificationAdmin', [
                'type' => 'error',
                'message' => $e->validator->errors()->first(),
                'title' => 'Gagal'
            ]);
        }
    }

    // edit diskon code
    #[On('editDiskonCode')]
    public function editDiskonCode($id)
    {
        $diskonCode = DiskonCodeModel::find($id);

        $this->code = $diskonCode->code;
        $this->description = $diskonCode->description;
        $this->discount = $diskonCode->discount;
        $this->start_date = $diskonCode->start_date;
        $this->end_date = $diskonCode->end_date;
        $this->penggunaan = $diskonCode->penggunaan;

        $this->diskonId = $id;
        $this->isEdit = true;

        $this->dispatch('modal-diskon-code');
    }

    public function updateDiskonCode()
    {
        try {
            $this->validate([
                'code' => 'required|string|unique:diskon_codes,code,' . $this->diskonId,
                'description' => 'required',
                'discount' => 'required|numeric',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'penggunaan' => 'required|integer',
            ]);

            $diskonCode = DiskonCodeModel::find($this->diskonId);

            $today = now()->format('Y-m-d');
            $status = $this->start_date < $today ? 'aktif' : ($this->start_date === $today ? 'aktif' : 'tidak aktif');
            
            $diskonCode->update([
                'code' => $this->code,
                'description' => $this->description,
                'discount' => $this->discount,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'penggunaan' => $this->penggunaan,
                'status' => $status,
            ]);
            
            $this->dispatch('management-diskon-code')->to(DiskonCode::class);
            $this->resetInput();
            
            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Diskon code berhasil diupdate',
                'title' => 'Berhasil'
            ]);
        } catch (ValidationException $e) {
            $this->dispatch('notificationAdmin', [
                'type' => 'error',
                'message' => $e->validator->errors()->first(),
                'title' => 'Gagal'
            ]);
        }
    }
    // edit diskon code
    
    // create diskon code
    public function render()
    {
        return view('livewire.pages.admin.diskon.diskon-code.modal-diskon-code');
    }

    // reset input
    public function resetInput()
    {
        $this->code = null;
        $this->description = null;
        $this->discount = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->penggunaan = null;

        $this->isEdit = false;
        $this->diskonId = null;

        $this->dispatch('close-modal-diskon-code');
    }

    // Message for validation
    protected $messages = [
        'code.required' => 'Kode diskon tidak boleh kosong',
        'code.unique' => 'Kode diskon sudah digunakan',
        'description.required' => 'Deskripsi diskon tidak boleh kosong',
        'discount.required' => 'Total diskon tidak boleh kosong',
        'discount.numeric' => 'Total diskon harus berupa angka',
        'start_date.required' => 'Tanggal mulai diskon tidak boleh kosong',
        'end_date.required' => 'Tanggal berakhir diskon tidak boleh kosong',
        'end_date.after_or_equal' => 'Tanggal berakhir diskon harus setelah atau sama dengan tanggal mulai diskon',
        'penggunaan.required' => 'Jumlah penggunaan diskon tidak boleh kosong',
        'penggunaan.integer' => 'Jumlah penggunaan diskon harus berupa angka',
    ];
}
