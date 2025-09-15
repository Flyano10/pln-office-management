<?php

namespace App\Http\Controllers;

use App\Models\Operasional;
use App\Models\PlnOffice;
use Illuminate\Http\Request;

class OperasionalController extends Controller
{
    public function index()
    {
        $operasionals = Operasional::with('kantor')->paginate(10);
        return view('admin.operasional.index', compact('operasionals'));
    }

    public function create()
    {
        $offices = PlnOffice::all();
        return view('admin.operasional.create', compact('offices'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kantor_id' => 'required|exists:pln_offices,id',
            'jumlah_pegawai' => 'nullable|integer|min:0',
            'divisi_departemen' => 'nullable|string|max:255',
            'pic_nama' => 'nullable|string|max:255',
            'nomor_kontak' => 'nullable|string|max:20',
            'jam_operasional' => 'nullable|string|max:100',
            'keamanan' => 'nullable|string',
            'catatan_tambahan' => 'nullable|string',
        ]);

        // Convert keamanan string with commas to JSON string before saving
        if (isset($validated['keamanan']) && is_string($validated['keamanan'])) {
            $validated['keamanan'] = json_encode(array_map('trim', explode(',', $validated['keamanan'])));
        }

        Operasional::create($validated);

        return redirect()->route('admin.operasional.index')->with('success', 'Data operasional berhasil ditambahkan!');
    }

    public function show(Operasional $operasional)
    {
        return view('admin.operasional.show', compact('operasional'));
    }

    public function edit(Operasional $operasional)
    {
        $offices = PlnOffice::all();
        return view('admin.operasional.edit', compact('operasional', 'offices'));
    }

    public function update(Request $request, Operasional $operasional)
    {
        $validated = $request->validate([
            'kantor_id' => 'required|exists:pln_offices,id',
            'jumlah_pegawai' => 'nullable|integer|min:0',
            'divisi_departemen' => 'nullable|string|max:255',
            'pic_nama' => 'nullable|string|max:255',
            'nomor_kontak' => 'nullable|string|max:20',
            'jam_operasional' => 'nullable|string|max:100',
            'keamanan' => 'nullable|string',
            'catatan_tambahan' => 'nullable|string',
        ]);

        $operasional->update($validated);

        return redirect()->route('admin.operasional.index')->with('success', 'Data operasional berhasil diperbarui!');
    }

    public function destroy(Operasional $operasional)
    {
        $operasional->delete();
        return redirect()->route('admin.operasional.index')->with('success', 'Data operasional berhasil dihapus!');
    }
}
