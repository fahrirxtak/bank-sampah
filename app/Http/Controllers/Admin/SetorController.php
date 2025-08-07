<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sampah;
use App\Models\TransaksiSetor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetorController extends Controller
{
    public function index()
    {
        $sampahs = Sampah::all();
        $transaksi = TransaksiSetor::with(['user', 'sampah'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.setor.index', compact('sampahs', 'transaksi'));
    }
}
