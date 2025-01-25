<?php

namespace App\Livewire\Pages\User\SewaBaju;

use App\Models\Layanan\SewaBaju;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['title' => 'Detail Sewa Baju'])]
class DetailSewaBaju extends Component
{
    public $baju;

    public function mount($slug)
    {
        $this->baju = SewaBaju::with(['imageSewaBajus'])->where('slug', $slug)->first();
    }
    
    public function render()
    {
        $rekomendBaju = SewaBaju::with(['ImageSewaBajus'])->inRandomOrder()->take(4)->get();
        
        return view('livewire.pages.user.sewa-baju.detail-sewa-baju', compact('rekomendBaju'));
    }
}
