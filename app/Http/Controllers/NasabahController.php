<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiTarik;
use Illuminate\Support\Facades\Auth;

class NasabahController extends Controller
{
    public function saldo()
    {
        $user = Auth::user();

        if ($user->role !== 'nasabah') {
            abort(403, 'Hanya nasabah yang bisa mengakses halaman ini.');
        }

        return view('nasabah.saldo', [
            'user' => $user
        ]);
    }

        public function tarikTunai()
    {
        $riwayat = TransaksiTarik::where('user_id', Auth::id())->latest()->get();
        return view('nasabah.tarik_tunai', compact('riwayat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah_tarik' => 'required|numeric|min:1000',
        ]);

        $user = Auth::user();

        if ($request->jumlah_tarik > $user->saldo) {
            return back()->with('error', 'Saldo tidak cukup.');
        }

        TransaksiTarik::create([
            'user_id' => $user->id,
            'jumlah_tarik' => $request->jumlah_tarik,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Permintaan penarikan berhasil dikirim. Menunggu konfirmasi admin.');
    }
}

