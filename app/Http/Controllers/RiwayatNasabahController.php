<?php

namespace App\Http\Controllers;

use App\Models\TransaksiNasabah;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RiwayatNasabahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $dateFilter = $request->query('date_filter');
        $typeFilter = $request->query('type_filter');

        // Base query dengan filter nasabah yang login
        $query = TransaksiNasabah::where('nasabah_id', auth()->id());

        // Filter pencarian
        if ($search) {
            $query->where('keterangan', 'like', '%' . $search . '%');
        }

        // Filter berdasarkan tanggal
        if ($dateFilter) {
            switch ($dateFilter) {
                case 'today':
                    $query->whereDate('created_at', Carbon::today());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', Carbon::now()->month)
                          ->whereYear('created_at', Carbon::now()->year);
                    break;
                case 'year':
                    $query->whereYear('created_at', Carbon::now()->year);
                    break;
            }
        }

        // Filter berdasarkan tipe transaksi (ubah penarikan menjadi pengeluaran)
        if ($typeFilter && in_array($typeFilter, ['pemasukan', 'pengeluaran'])) {
            $query->where('tipe', $typeFilter);
        }

        // Ambil data dengan pagination
        $transaksis = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistik untuk dashboard cards
        $totalPemasukan = TransaksiNasabah::where('nasabah_id', auth()->id())
            ->where('tipe', 'pemasukan')
            ->sum('jumlah');

        $totalPengeluaran = TransaksiNasabah::where('nasabah_id', auth()->id())
            ->where('tipe', 'pengeluaran')
            ->sum('jumlah');

        // Ambil saldo langsung dari users
        $saldoAkhir = auth()->user()->saldo;

        // Statistik bulan lalu untuk perbandingan
        $bulanLalu = Carbon::now()->subMonth();

        $pemasukanBulanLalu = TransaksiNasabah::where('nasabah_id', auth()->id())
            ->where('tipe', 'pemasukan')
            ->whereMonth('created_at', $bulanLalu->month)
            ->whereYear('created_at', $bulanLalu->year)
            ->sum('jumlah');

        $pengeluaranBulanLalu = TransaksiNasabah::where('nasabah_id', auth()->id())
            ->where('tipe', 'pengeluaran')
            ->whereMonth('created_at', $bulanLalu->month)
            ->whereYear('created_at', $bulanLalu->year)
            ->sum('jumlah');

        // Hitung persentase perubahan
        $perubahanPemasukan = $pemasukanBulanLalu > 0
            ? (($totalPemasukan - $pemasukanBulanLalu) / $pemasukanBulanLalu) * 100
            : 0;

        $perubahanPengeluaran = $pengeluaranBulanLalu > 0
            ? (($totalPengeluaran - $pengeluaranBulanLalu) / $pengeluaranBulanLalu) * 100
            : 0;

        // Data untuk view
        $data = compact(
            'transaksis',
            'totalPemasukan',
            'totalPengeluaran',
            'saldoAkhir',
            'perubahanPemasukan',
            'perubahanPengeluaran',
            'search',
            'dateFilter',
            'typeFilter'
        );

        return view('nasabah.riwayat-transaksi', $data);
    }
}
