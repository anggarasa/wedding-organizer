<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\Diskon\DiskonCode;
use App\Models\Diskon\DiskonPaketPernikahan;
use App\Models\Diskon\DiskonSewaBaju;

class UpdateDiskonStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:diskon-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status diskon secara otomatis berdasarkan start_date dan end_date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        // 1. Ubah status menjadi "kadaluarsa" jika end_date sudah lewat
        $diskonsKadaluarsaPaket = DiskonPaketPernikahan::where('end_date', '<=', $today)
            ->where('status', 'aktif')
            ->get();

        foreach ($diskonsKadaluarsaPaket as $diskon) {
            // Ubah status menjadi kadaluarsa
            $diskon->update(['status' => 'kadaluarsa']);

            // Reset discount dan final_price pada produk terkait
            foreach ($diskon->paketPernikahans as $paket) {
                $paket->update([
                    'discount' => null,
                    'final_price' => null,
                ]);
            }
        }

        DiskonCode::where('end_date', '<=', $today)
            ->where('status', 'aktif')
            ->update(['status' => 'kadaluarsa']);

        $diskonsKadaluarsaBaju = DiskonSewaBaju::where('end_date', '<=', $today)
            ->where('status', 'aktif')
            ->get();

        foreach ($diskonsKadaluarsaBaju as $diskon) {
            // Ubah status menjadi kadaluarsa
            $diskon->update(['status' => 'kadaluarsa']);

            // Reset discount dan final_price pada produk terkait
            foreach ($diskon->sewaBajus as $baju) {
                $baju->update([
                    'discount' => null,
                    'final_price' => null,
                ]);
            }
        }

        // 2. Terapkan diskon yang mulai hari ini
        $diskonsAktifPaket = DiskonPaketPernikahan::where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->where('status', 'tidak aktif')
            ->get();

        foreach ($diskonsAktifPaket as $diskon) {
            // Ubah status menjadi aktif
            $diskon->update(['status' => 'aktif']);

            // Terapkan diskon pada produk terkait
            foreach ($diskon->paketPernikahans as $paket) {
                $paket->discount = $diskon->discount; // Memicu setter
                $paket->save();
            }
        }

        DiskonCode::where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->where('status', 'tidak aktif')
            ->update(['status' => 'aktif']);

        $diskonsAktifBaju = DiskonSewaBaju::where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->where('status', 'tidak aktif')
            ->get();

        foreach ($diskonsAktifBaju as $diskon) {
            // Ubah status menjadi aktif
            $diskon->update(['status' => 'aktif']);

            // Terapkan diskon pada produk terkait
            foreach ($diskon->sewaBajus as $baju) {
                $baju->discount = $diskon->discount; // Memicu setter
                $baju->save();
            }
        }


        $this->info('Status diskon berhasil diperbarui.');
    }
}
