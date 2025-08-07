<?php

namespace App\Http\Controllers;

use App\Models\Sampah;
use Illuminate\Http\Request;

class HargaSampahController extends Controller
{

    public function index()
    {
        $sampah = Sampah::all();
        return view('nasabah.harga_sampah', compact('sampah'));
    }
}
