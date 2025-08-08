<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TransaksiTarik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PenarikanController extends Controller
{
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

