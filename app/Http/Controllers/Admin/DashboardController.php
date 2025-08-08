<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RiwayatTransaksi;
use App\Models\TransaksiOperasional;
use App\Models\TransaksiSetor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total berat sampah (kg)
        $totalSampah = TransaksiSetor::sum('berat');

        // Total nasabah aktif
        $nasabahAktif = User::where('role', 'nasabah')->count();

        // totalPendapatan
        $totalPendapatan = RiwayatTransaksi::where('kategori', 'pemasukan')->sum('jumlah');


        // ================================
        // 📊 Data untuk Chart Bulanan
        // ================================
        $sampahBulanan = TransaksiSetor::select(
            DB::raw('MONTH(tanggal_setor) as bulan'),
            DB::raw('SUM(berat) as total_berat')
        )
            ->whereYear('tanggal_setor', date('Y'))
            ->groupBy(DB::raw('MONTH(tanggal_setor)'))
            ->orderBy('bulan')
            ->get();

        // Buat array untuk semua bulan (1-12)
        $allMonths = range(1, 12);
        $labelsBulanan = [];
        $dataBulanan = array_fill(0, 12, 0); // Inisialisasi dengan 0 untuk semua bulan

        // Isi data yang ada
        foreach ($sampahBulanan as $item) {
            $monthIndex = $item->bulan - 1; // Karena array dimulai dari 0
            $dataBulanan[$monthIndex] = $item->total_berat;
        }

        // Buat label untuk semua bulan
        foreach ($allMonths as $month) {
            $labelsBulanan[] = date('F', mktime(0, 0, 0, $month, 1));
        }

        // ================================
        // 🧾 Komposisi Sampah per Jenis
        // ================================
        // Pastikan relasi ke model Sampah sudah dibuat: TransaksiSetor->sampah->nama_jenis

        $komposisiJenis = TransaksiSetor::select(
            'sampah_id',
            DB::raw('SUM(berat) as total')
        )
            ->groupBy('sampah_id')
            ->with('sampah') // relasi ke model Sampah
            ->get();

        $jenisLabels = [];
        $jenisData = [];

        foreach ($komposisiJenis as $item) {
            $jenisLabels[] = optional($item->sampah)->nama ?? 'Tidak Diketahui';
            $jenisData[] = $item->total;
        }

        // topNasabah
        $topNasabah = TransaksiSetor::select('user_id', DB::raw('SUM(berat) as total_berat'), DB::raw('SUM(total_harga) as total_uang'))
            ->groupBy('user_id')
            ->orderByDesc('total_berat')
            ->take(3)
            ->with('user') // pastikan relasi user sudah ada di model
            ->get();


        return view('admin.dashboard', compact(
            'totalSampah',
            'nasabahAktif',
            'totalPendapatan',
            'labelsBulanan',
            'dataBulanan',
            'jenisLabels',
            'jenisData',
            'topNasabah'
        ));
    }
}
