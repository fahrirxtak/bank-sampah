<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Sampah;
use Illuminate\Http\Request;
use App\Models\TransaksiSetor;
use App\Models\TransaksiTarik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SetorController extends Controller
{
    public function index()
    {
        $users = User::all();
        $ajuan = TransaksiTarik::with('user')->where('status', 'pending')->get();
        $sampahs = Sampah::all();
        $transaksi = TransaksiSetor::with(['user', 'sampah'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.setor.index', compact('users', 'ajuan', 'sampahs', 'transaksi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sampah_id' => 'required|exists:sampah,id',
            'berat' => 'required|numeric|min:0.1',
            'catatan' => 'nullable|string'
        ]);

        $sampah = Sampah::findOrFail($request->sampah_id);
        $hargaPerKg = $sampah->harga_kg;
        $berat = $request->berat;
        $totalHarga = $hargaPerKg * $berat;

        TransaksiSetor::create([
            'user_id'       => $request->user_id,
            'sampah_id'     => $request->sampah_id,
            'berat'         => $berat,
            'total_harga'   => $totalHarga,
            'status'        => 'pending', // default
            'tanggal_setor' => now(),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        // Tambahkan saldo ke user
        $user = User::findOrFail($request->user_id);
        $user->saldo += $totalHarga;
        $user->save();

        return redirect()->back()->with('success', 'Setoran berhasil, saldo user ditambahkan.');
    }

    public function storeTunai(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jumlah_uang' => 'required|numeric|min:1000',
            'catatan' => 'nullable|string',
        ]);

        // Ambil user
        $user = User::findOrFail($request->user_id);

        // Tambahkan saldo
        $user->saldo += $request->jumlah_uang;
        $user->save();

        // Simpan riwayat transaksi setor tunai
        TransaksiSetor::create([
            'user_id' => $user->id,
            'total_harga' => $request->jumlah_uang,
            'catatan' => $request->catatan,
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

        return redirect()->back()->with('success', 'Penarikan dikonfirmasi dan saldo dikurangi.');
    }

    public function tarikOlehAdmin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jumlah_uang' => 'required|numeric|min:10000',
            'password_user' => 'required',
            'catatan' => 'required|string',
        ]);

        // Ambil data user
        $user = User::findOrFail($request->user_id);

        // Cek password
        if (!Hash::check($request->password_user, $user->password)) {
            return back()->withErrors(['password_user' => 'Password user salah!']);
        }

        // Cek saldo cukup
        if ($user->saldo < $request->jumlah_uang) {
            return back()->withErrors(['jumlah_uang' => 'Saldo user tidak mencukupi']);
        }

        // Buat transaksi tarik tunai (langsung approved)
        TransaksiTarik::create([
            'user_id' => $user->id,
            'jumlah_tarik' => $request->jumlah_uang,
            'status' => 'approved',
            'tanggal_tarik' => now(),
        ]);

        // Kurangi saldo user
        $user->saldo -= $request->jumlah_uang;
        $user->save();

        return back()->with('success', 'Penarikan berhasil dan saldo user telah dikurangi.');
    }
}
