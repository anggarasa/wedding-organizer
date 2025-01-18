<?php

namespace App\Livewire\Pages\User;

use App\Models\Layanan\PaketPernikahan;
use App\Models\Layanan\SewaBaju;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['title' => 'Home'])]
class Dashboard extends Component
{
    public Collection $rekomendasi;

    public function mount() 
    {
        $paket = PaketPernikahan::with(['imagePaketPernikahans'])->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'type' => 'paket',
                'name' => $item->name,
                'price' => $item->price,
                'images' => $item->imagePaketPernikahans,
            ];
        });;
        $baju = SewaBaju::with(['imageSewaBajus'])->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'type' => 'baju',
                'name' => $item->name,
                'price' => $item->price,
                'images' => $item->imageSewaBajus,
            ];
        });;

        $this->rekomendasi = $paket->concat($baju)->shuffle();
    }
    
    public function render()
    {
        return view('livewire.pages.user.dashboard');
    }
}
