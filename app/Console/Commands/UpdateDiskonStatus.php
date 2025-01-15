<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\Diskon\DiskonCode;
use App\Models\Diskon\DiskonPaketPernikahan;

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
        DiskonPaketPernikahan::where('end_date', '<=', $today)
            ->where('status', 'aktif')
            ->update(['status' => 'kadaluarsa']);

        DiskonCode::where('end_date', '<=', $today)
            ->where('status', 'aktif')
            ->update(['status' => 'kadaluarsa']);

        // 2. Ubah status menjadi "aktif" jika start_date sudah sampai atau lewat
        DiskonPaketPernikahan::where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->where('status', 'tidak aktif')
            ->update(['status' => 'aktif']);

        DiskonCode::where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->where('status', 'tidak aktif')
            ->update(['status' => 'aktif']);

        $this->info('Status diskon berhasil diperbarui.');
    }
}
