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
    public Collection $allRekomendasi;
    public $rekomendasi;
    public $itemsToShow = 10;

    public function mount() 
    {
        $paket = PaketPernikahan::with(['imagePaketPernikahans'])->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'slug' => $item->slug,
                'type' => 'paket',
                'name' => $item->name,
                'price' => $item->price,
                'images' => $item->imagePaketPernikahans,
                'discount' => $item->discount,
                'finalPrice' => $item->final_price,
            ];
        });

        $baju = SewaBaju::with(['imageSewaBajus'])->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'slug' => $item->slug,
                'type' => 'baju',
                'name' => $item->name,
                'price' => $item->price,
                'images' => $item->imageSewaBajus,
                'discount' => $item->discount,
                'finalPrice' => $item->final_price,
            ];
        });

        $this->allRekomendasi = $paket->concat($baju)->shuffle();
        $this->rekomendasi = $this->allRekomendasi->take($this->itemsToShow);
    }

    public function showMore()
    {
        $this->itemsToShow += 10;
        $this->rekomendasi = $this->allRekomendasi->take($this->itemsToShow);
    }
    
    public function render()
    {
        return view('livewire.pages.user.dashboard');
    }
}
