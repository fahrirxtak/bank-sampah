<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class NasabahController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'nasabah');

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('alamat', 'LIKE', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        $allowedSorts = ['name', 'email', 'saldo', 'status', 'created_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $nasabah = $query->paginate(5);

        // Calculate statistics
        $stats = [
            'total_nasabah' => User::where('role', 'nasabah')->count(),
            'nasabah_active' => User::where('role', 'nasabah')->where('status', 'active')->count(),
            'nasabah_inactive' => User::where('role', 'nasabah')->where('status', 'inactive')->count(),
            'total_saldo' => User::where('role', 'nasabah')->sum('saldo'),
            'rata_rata_saldo' => User::where('role', 'nasabah')->avg('saldo') ?? 0,
        ];

        return view('admin.nasabah.index', compact('nasabah', 'stats'));
    }

    /**
     * Show the form for creating a new nasabah.
     */
    public function create()
    {
        return view('admin.nasabah.create');
    }

    /**
     * Store a newly created nasabah in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'saldo' => 'nullable|numeric|min:0|max:999999999999.99',
            'status' => 'required|in:active,inactive',
            'alamat' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'saldo.numeric' => 'Saldo harus berupa angka',
            'saldo.min' => 'Saldo tidak boleh kurang dari 0',
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $nasabah = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'nasabah',
                'saldo' => $request->saldo ?? 0,
                'status' => $request->status,
                'alamat' => $request->alamat,
                'email_verified_at' => now(),
            ]);

            return redirect()->route('admin.nasabah.index')
                ->with('success', 'Nasabah berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified nasabah.
     */
    public function show($id)
    {
        $nasabah = User::where('role', 'nasabah')->findOrFail($id);

        // Get transaction history if you have transactions table
        // $transactions = $nasabah->transactions()->latest()->paginate(10);

        return view('admin.nasabah.show', compact('nasabah'));
    }

    /**
     * Show the form for editing the specified nasabah.
     */
    public function edit($id)
    {
        $nasabah = User::where('role', 'nasabah')->findOrFail($id);
        return view('admin.nasabah.edit', compact('nasabah'));
    }

    /**
     * Update the specified nasabah in storage.
     */
    public function update(Request $request, $id)
    {
        $nasabah = User::where('role', 'nasabah')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($id)
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'saldo' => 'nullable|numeric|min:0|max:999999999999.99',
            'status' => 'required|in:active,inactive',
            'alamat' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'saldo.numeric' => 'Saldo harus berupa angka',
            'saldo.min' => 'Saldo tidak boleh kurang dari 0',
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $updateData = [
                'name' => $request->name,
                'email' => $request->email,
                'saldo' => $request->saldo ?? $nasabah->saldo,
                'status' => $request->status,
                'alamat' => $request->alamat,
            ];

            // Only update password if provided
            if (!empty($request->password)) {
                $updateData['password'] = Hash::make($request->password);
            }

            $nasabah->update($updateData);

            return redirect()->route('admin.nasabah.index')
                ->with('success', 'Data nasabah berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified nasabah from storage.
     */
    public function destroy($id)
    {
        try {
            $nasabah = User::where('role', 'nasabah')->findOrFail($id);
            $nasabah->delete();

            return response()->json([
                'success' => true,
                'message' => 'Nasabah berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus nasabah: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update saldo nasabah
     */
    public function updateSaldo(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'saldo' => 'required|numeric|min:0|max:999999999999.99',
            'keterangan' => 'nullable|string|max:255'
        ], [
            'saldo.required' => 'Jumlah saldo harus diisi',
            'saldo.numeric' => 'Saldo harus berupa angka',
            'saldo.min' => 'Saldo tidak boleh kurang dari 0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $nasabah = User::where('role', 'nasabah')->findOrFail($id);
            $saldoLama = $nasabah->saldo;

            $nasabah->update([
                'saldo' => $request->saldo
            ]);

            // Log the saldo change if you have logging system
            // SaldoLog::create([
            //     'user_id' => $nasabah->id,
            //     'saldo_lama' => $saldoLama,
            //     'saldo_baru' => $request->saldo,
            //     'keterangan' => $request->keterangan,
            //     'admin_id' => auth()->id(),
            // ]);

            return response()->json([
                'success' => true,
                'message' => 'Saldo berhasil diperbarui!',
                'saldo' => number_format($request->saldo, 0, ',', '.')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle status nasabah (active/inactive)
     */
    public function toggleStatus($id)
    {
        try {
            $nasabah = User::where('role', 'nasabah')->findOrFail($id);

            $newStatus = $nasabah->status == 'active' ? 'inactive' : 'active';
            $nasabah->update(['status' => $newStatus]);

            return response()->json([
                'success' => true,
                'message' => 'Status nasabah berhasil diubah!',
                'status' => $newStatus
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export nasabah data to Excel/CSV
     */
    public function export(Request $request)
    {
        $format = $request->get('format', 'xlsx');

        // You can use Laravel Excel package for this
        // return Excel::download(new NasabahExport, 'nasabah.' . $format);
    }

    /**
     * Get nasabah statistics for dashboard
     */
    public function getStatistics()
    {
        $stats = [
            'total_nasabah' => User::where('role', 'nasabah')->count(),
            'nasabah_active' => User::where('role', 'nasabah')->where('status', 'active')->count(),
            'nasabah_inactive' => User::where('role', 'nasabah')->where('status', 'inactive')->count(),
            'total_saldo' => User::where('role', 'nasabah')->sum('saldo'),
            'rata_rata_saldo' => User::where('role', 'nasabah')->avg('saldo') ?? 0,
            'nasabah_bulan_ini' => User::where('role', 'nasabah')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Search nasabah for AJAX requests
     */
    public function search(Request $request)
    {
        $search = $request->get('q');

        $nasabah = User::where('role', 'nasabah')
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->select('id', 'name', 'email', 'saldo', 'status')
            ->limit(10)
            ->get();

        return response()->json($nasabah);
    }
}
