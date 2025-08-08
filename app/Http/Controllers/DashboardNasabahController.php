<?php

namespace App\Http\Controllers;

use App\Models\Sampah;
use App\Models\TransaksiNasabah;
use Illuminate\Http\Request;
use App\Models\TransaksiSetor;
use App\Models\TransaksiTarik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardNasabahController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        // Total setoran (berat)
        $totalSetoran = TransaksiSetor::where('user_id', $userId)
            ->sum('berat');

        // Setoran bulan ini
        $setoranBulanIni = TransaksiSetor::where('user_id', $userId)
            ->whereMonth('tanggal_setor', now()->month)
            ->sum('berat');

        // Saldo dari table users
        $saldo = $user->saldo;

        // Saldo bulan ini = total setoran uang bulan ini
        $saldoBulanIni = TransaksiSetor::where('user_id', $userId)
            ->whereMonth('tanggal_setor', now()->month)
            ->sum('total_harga');

        // Total tarikan
        $totalTarikan = TransaksiTarik::where('user_id', $userId)
            ->sum('jumlah_tarik');

        // Jumlah tarikan bulan ini
        $tarikanBulanIni = TransaksiTarik::where('user_id', $userId)
            ->whereMonth('tanggal_tarik', now()->month)
            ->count();

        // Data untuk grafik setoran per bulan
        $setoranPerBulan = TransaksiSetor::select(
            DB::raw('MONTH(tanggal_setor) as bulan'),
            DB::raw('SUM(berat) as total_berat')
        )
            ->where('user_id', $userId)
            ->whereYear('tanggal_setor', now()->year)
            ->groupBy(DB::raw('MONTH(tanggal_setor)'))
            ->pluck('total_berat', 'bulan')
            ->toArray();

        // Susun data 12 bulan, kalau tidak ada isi 0
        $chartSetoran = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartSetoran[] = $setoranPerBulan[$i] ?? 0;
        }

        // Data untuk grafik jenis sampah
        // Komposisi jenis sampah khusus user login
        $jenisSampah = TransaksiSetor::select(
            'sampah_id',
            DB::raw('SUM(berat) as total')
        )
            ->where('user_id', Auth::id()) // filter berdasarkan user login
            ->groupBy('sampah_id')
            ->with('sampah') // relasi ke model Sampah
            ->get();

        $jenisLabels = [];
        $jenisData = [];

        foreach ($jenisSampah as $item) {
            $jenisLabels[] = optional($item->sampah)->nama ?? 'Tidak Diketahui';
            $jenisData[] = $item->total;
        }

        $transaksi = TransaksiNasabah::where('nasabah_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $sampah = Sampah::orderBy('nama')->get();

        return view('nasabah.dashboard', compact(
            'totalSetoran',
            'setoranBulanIni',
            'saldo',
            'saldoBulanIni',
            'totalTarikan',
            'tarikanBulanIni',
            'chartSetoran',
            'jenisLabels',
            'jenisData',
            'transaksi',
            'sampah'
        ));
    }
}
