<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Sampah;
use Illuminate\Http\Request;
use App\Models\TransaksiSetor;
use App\Models\TransaksiTarik;
use App\Http\Controllers\Controller;
use App\Models\RiwayatTransaksi;
use App\Models\TransaksiNasabah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SetorController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('role', 'nasabah')->get();
        $sampahs = Sampah::all();

        $ajuan = TransaksiTarik::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $transaksi = TransaksiSetor::with(['user', 'sampah'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Query untuk riwayat transaksi dengan filter
        $riwayatTransaksi = RiwayatTransaksi::query()
            ->when($request->tipe, function ($query) use ($request) {
                return $query->where('tipe', $request->tipe);
            })
            ->when($request->kategori, function ($query) use ($request) {
                return $query->where('kategori', $request->kategori);
            })
            ->when($request->search, function ($query) use ($request) {
                return $query->where('keterangan', 'like', '%' . $request->search . '%');
            })
            ->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->appends($request->query());

        return view('admin.setor.index', compact(
            'users',
            'ajuan',
            'sampahs',
            'transaksi',
            'riwayatTransaksi'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sampah_id' => 'required|exists:sampah,id',
            'berat'     => 'required|numeric|min:0.1',
            'catatan'   => 'nullable|string',
            'user_id'   => 'required|exists:users,id'
        ]);

        $sampah = Sampah::findOrFail($request->sampah_id);
        $hargaPerKg = $sampah->harga_kg;
        $berat = $request->berat;
        $totalHarga = $hargaPerKg * $berat;
        $user = User::findOrFail($request->user_id);

        // Buat transaksi setor sampah
        TransaksiSetor::create([
            'user_id'       => $request->user_id,
            'sampah_id'     => $request->sampah_id,
            'berat'         => $berat,
            'total_harga'   => $totalHarga,
            'status'        => 'pending',
            'tanggal_setor' => now(),
        ]);

        // Buat transaksi nasabah
        TransaksiNasabah::create([
            'nasabah_id'  => $request->user_id,
            'tipe'        => 'pemasukan',
            'keterangan'  => 'Setoran sampah: ' . $sampah->nama . ' (' . $berat . ' kg)',
            'jumlah'      => $totalHarga,
            'status'      => 'selesai',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        // Tambahkan saldo ke user
        $user->saldo += $totalHarga;
        $user->save();

        // Catat ke riwayat_transaksi
        $this->catatRiwayat($user->id, 'setor', 'pemasukan', $totalHarga, 'Setor sampah: ' . $sampah->nama . ' (' . $berat . ' kg)');

        return redirect()->back()->with('success', 'Setoran berhasil, saldo user ditambahkan.');
    }

    public function storeTunai(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'jumlah_uang' => 'required|numeric|min:1000',
            'catatan'     => 'nullable|string',
        ]);

        $user = User::findOrFail($request->user_id);

        // Tambahkan saldo
        $user->saldo += $request->jumlah_uang;
        $user->save();

        // Simpan riwayat transaksi setor tunai
        TransaksiSetor::create([
            'user_id'     => $user->id,
            'total_harga' => $request->jumlah_uang,
            'catatan'     => $request->catatan,
        ]);

        // Catat ke riwayat_transaksi
        $this->catatRiwayat(
            $user->id,
            'setor',
            'pemasukan',
            $request->jumlah_uang,
            'Setor tunai'
        );

        // Catat ke TransaksiNasabah
        TransaksiNasabah::create([
            'nasabah_id' => $user->id,
            'tipe'       => 'pemasukan',
            'keterangan' => 'Setor tunai',
            'jumlah'     => $request->jumlah_uang,
            'status'     => 'selesai',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Setoran tunai berhasil! Saldo user telah ditambahkan.');
    }


    public function konfirmasi($id)
    {
        $Penarikan = TransaksiTarik::findOrFail($id);

        if ($Penarikan->status !== 'pending') {
            return redirect()->back()->with('error', 'Penarikan sudah dikonfirmasi.');
        }

        $user = $Penarikan->user;

        if ($user->saldo < $Penarikan->jumlah_tarik) {
            return redirect()->back()->with('error', 'Saldo tidak mencukupi.');
        }

        // Kurangi saldo user
        $user->saldo -= $Penarikan->jumlah_tarik;
        $user->save();

        // Update status penarikan
        $Penarikan->status = 'approved';
        $Penarikan->save();

        // Catat ke riwayat_transaksi
        $this->catatRiwayat(
            $user->id,
            'tarik',
            'pengeluaran',
            $Penarikan->jumlah_tarik,
            'Penarikan saldo disetujui admin'
        );

        // Catat ke TransaksiNasabah
        TransaksiNasabah::create([
            'nasabah_id' => $user->id,
            'tipe'       => 'pengeluaran',
            'keterangan' => 'Tarik tunai disetujui admin',
            'jumlah'     => $Penarikan->jumlah_tarik,
            'status'     => 'selesai',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Penarikan dikonfirmasi dan saldo dikurangi.');
    }


    public function tarikOlehAdmin(Request $request)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
            'jumlah_uang'   => 'required|numeric|min:10000',
            'password_user' => 'required',
            'catatan'       => 'required|string',
        ]);

        $user = User::findOrFail($request->user_id);

        if (!Hash::check($request->password_user, $user->password)) {
            return back()->withErrors(['password_user' => 'Password user salah!']);
        }

        if ($user->saldo < $request->jumlah_uang) {
            return back()->withErrors(['jumlah_uang' => 'Saldo user tidak mencukupi']);
        }

        // Buat transaksi tarik tunai (langsung approved)
        TransaksiTarik::create([
            'user_id'       => $user->id,
            'jumlah_tarik'  => $request->jumlah_uang,
            'status'        => 'approved',
            'tanggal_tarik' => now(),
        ]);

        // Kurangi saldo user
        $user->saldo -= $request->jumlah_uang;
        $user->save();

        // Catat ke riwayat_transaksi
        $this->catatRiwayat(
            $user->id,
            'tarik',
            'pengeluaran',
            $request->jumlah_uang,
            'Penarikan saldo oleh admin'
        );

        // Catat ke TransaksiNasabah
        TransaksiNasabah::create([
            'nasabah_id' => $user->id,
            'tipe'       => 'pengeluaran',
            'keterangan' => 'Tarik tunai oleh admin',
            'jumlah'     => $request->jumlah_uang,
            'status'     => 'selesai',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Penarikan berhasil dan saldo user telah dikurangi.');
    }


    /**
     * Helper untuk mencatat riwayat transaksi
     */
    private function catatRiwayat($userId, $tipe, $kategori, $jumlah, $keterangan)
    {
        DB::table('riwayat_transaksi')->insert([
            'user_id'    => $userId,
            'tipe'       => $tipe,       // setor, tarik, operasional
            'kategori'   => $kategori,   // pemasukan, pengeluaran
            'jumlah'     => $jumlah,
            'keterangan' => $keterangan,
            'tanggal'    => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
