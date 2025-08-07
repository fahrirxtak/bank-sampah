<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
}

