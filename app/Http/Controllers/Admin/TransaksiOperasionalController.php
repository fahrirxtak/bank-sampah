<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransaksiOperasional;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiOperasionalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $sort = $request->query('sort', 'tanggal_desc');

        $transaksis = TransaksiOperasional::with('admin')
            ->when($search, function ($query) use ($search) {
                return $query->where('keterangan', 'like', '%' . $search . '%');
            })
            ->when($sort, function ($query) use ($sort) {
                switch ($sort) {
                    case 'tanggal_asc':
                        return $query->orderBy('tanggal', 'asc');
                    case 'tanggal_desc':
                        return $query->orderBy('tanggal', 'desc');
                    case 'jumlah_asc':
                        return $query->orderBy('jumlah', 'asc');
                    case 'jumlah_desc':
                        return $query->orderBy('jumlah', 'desc');
                    default:
                        return $query->orderBy('tanggal', 'desc');
                }
            })
            ->paginate(10);

        // Calculate statistics
        $totalPemasukan = TransaksiOperasional::where('tipe', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = TransaksiOperasional::where('tipe', 'pengeluaran')->sum('jumlah');

        return view('admin.transaksi.index', [
            'transaksis' => $transaksis,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
        ]);
    }

    public function create()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.transaksi.create', compact('admins'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'admin_id' => 'required|exists:users,id',
            'tipe' => 'required|in:pemasukan,pengeluaran',
            'keterangan' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        // Ambil user/admin yang bersangkutan
        $admin = User::findOrFail($validated['admin_id']);

        // Update saldo admin sesuai tipe transaksi
        if ($validated['tipe'] === 'pemasukan') {
            $admin->saldo += $validated['jumlah'];
        } elseif ($validated['tipe'] === 'pengeluaran') {
            $admin->saldo -= $validated['jumlah'];
            // Optional: validasi biar saldo gak minus
            if ($admin->saldo < 0) {
                return back()->withErrors(['jumlah' => 'Saldo admin tidak mencukupi untuk pengeluaran ini.']);
            }
        }

        $admin->save(); // Simpan saldo baru

        // Simpan transaksi
        TransaksiOperasional::create($validated);

        return redirect()->route('admin.transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan dan saldo diperbarui.');
    }


    public function edit(TransaksiOperasional $transaksi)
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.transaksi.edit', compact('transaksi', 'admins'));
    }

    public function update(Request $request, TransaksiOperasional $transaksi)
    {
        $validated = $request->validate([
            'admin_id' => 'required|exists:users,id',
            'tipe' => 'required|in:pemasukan,pengeluaran',
            'keterangan' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        $transaksi->update($validated);

        return redirect()->route('admin.transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui');
    }

    public function destroy(TransaksiOperasional $transaksi)
    {

        $admin = $transaksi->admin;

        if ($admin) {
            if ($transaksi->tipe === 'pemasukan') {
                $admin->saldo -= $transaksi->jumlah;
            } elseif ($transaksi->tipe === 'pengeluaran') {
                $admin->saldo += $transaksi->jumlah;
            }
            $admin->save();
        }

        $transaksi->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Transaksi & saldo berhasil dihapus.']);
        }

        return redirect()->route('admin.transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus dan saldo diperbarui.');
    }



    // Optional: Monthly report method
    public function laporanBulanan()
    {
        $report = TransaksiOperasional::select(
            DB::raw('YEAR(tanggal) as tahun'),
            DB::raw('MONTH(tanggal) as bulan'),
            DB::raw('SUM(CASE WHEN tipe = "pemasukan" THEN jumlah ELSE 0 END) as pemasukan'),
            DB::raw('SUM(CASE WHEN tipe = "pengeluaran" THEN jumlah ELSE 0 END) as pengeluaran'),
            DB::raw('SUM(CASE WHEN tipe = "pemasukan" THEN jumlah ELSE -jumlah END) as saldo')
        )
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->get();

        return view('admin.transaksi.laporan', compact('report'));
    }
}
