<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sampah;
use Illuminate\Http\Request;

class SampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'nama_asc');

        $query = Sampah::query();

        // Search
        if ($search) {
            $query->where('nama', 'like', "%{$search}%");
        }

        // Sorting
        switch ($sort) {
            case 'nama_desc':
                $query->orderBy('nama', 'desc');
                break;
            case 'harga_asc':
                $query->orderBy('harga_kg', 'asc');
                break;
            case 'harga_desc':
                $query->orderBy('harga_kg', 'desc');
                break;
            default:
                $query->orderBy('nama', 'asc');
        }

        $sampahs = $query->paginate(10);

        // Statistics
        $averagePrice = Sampah::avg('harga_kg');
        $highestPrice = Sampah::max('harga_kg');
        $lowestPrice = Sampah::min('harga_kg');

        return view('admin.sampah.index', compact('sampahs', 'averagePrice', 'highestPrice', 'lowestPrice'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sampah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga_kg' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:255',
        ]);

        Sampah::create($validated);

        return redirect()->route('admin.sampah.index')
            ->with('success', 'Data sampah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sampah $sampah)
    {
        return view('admin.sampah.show', compact('sampah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sampah = Sampah::findOrFail($id);
        return view('admin.sampah.edit', compact('sampah'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga_kg' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:255',
        ]);

        $sampah = Sampah::findOrFail($id);
        $sampah->update($validated);

        return redirect()->route('admin.sampah.index')
            ->with('success', 'Data sampah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $sampah = Sampah::findOrFail($id);
            $sampah->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil dihapus!'
                ]);
            }

            return redirect()->route('admin.sampah.index')
                ->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus data!'
                ], 500);
            }

            return redirect()->route('admin.sampah.index')
                ->with('error', 'Gagal menghapus data!');
        }
    }
}
