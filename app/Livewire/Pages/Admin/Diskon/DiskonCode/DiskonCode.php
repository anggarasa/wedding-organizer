<?php

namespace App\Livewire\Pages\Admin\Diskon\DiskonCode;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use App\Models\Diskon\DiskonCode as DiskonCodeModel;

#[Layout('layouts.admin-layout', ['title' => 'Management Diskon Code'])]
#[On('management-diskon-code')]
class DiskonCode extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.diskon.diskon-code.diskon-code', [
            'diskonCodes' => DiskonCodeModel::latest()->get()
        ]);
    }
}
