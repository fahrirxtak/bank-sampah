<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Sampah;
use Illuminate\Http\Request;
use App\Models\TransaksiSetor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SetorController extends Controller
{
    public function index()
    {
        $users = User::all();
        $sampahs = Sampah::all();
        $transaksi = TransaksiSetor::with(['user', 'sampah'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.setor.index', compact('users', 'sampahs', 'transaksi'));
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

        return redirect()->back()->with('success', 'Setoran berhasil diajukan.');
    }
}
