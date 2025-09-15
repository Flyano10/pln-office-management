<?php

namespace App\Http\Controllers;

use App\Models\Kontrak;
use App\Models\Gedung;
use Illuminate\Http\Request;

class KontrakController extends Controller
{
    public function index()
    {
        $kontraks = Kontrak::with('gedung')->paginate(10);
        return view('admin.kontrak.index', compact('kontraks'));
    }

    public function create()
    {
        $gedungs = Gedung::all();
        return view('admin.kontrak.create', compact('gedungs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'gedung_id' => 'required|exists:gedung,id',
            'jenis_kontrak' => 'required|in:Sewa,Milik,Hibah,Layanan',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
        ]);

        Kontrak::create($validated);

        // Redirect back to the create page instead of index
        return redirect()->route('admin.kontrak.create')->with('success', 'Data kontrak berhasil ditambahkan!');
    }

    public function show(Kontrak $kontrak)
    {
        return view('admin.kontrak.show', compact('kontrak'));
    }

    public function edit(Kontrak $kontrak)
    {
        $gedungs = Gedung::all();
        return view('admin.kontrak.edit', compact('kontrak', 'gedungs'));
    }

    public function update(Request $request, Kontrak $kontrak)
    {
        $validated = $request->validate([
            'gedung_id' => 'required|exists:gedung,id',
            'nomor_kontrak' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $kontrak->update($validated);

        return redirect()->route('admin.kontrak.index')->with('success', 'Data kontrak berhasil diperbarui!');
    }

    public function destroy(Kontrak $kontrak)
    {
        $kontrak->delete();
        return redirect()->route('admin.kontrak.index')->with('success', 'Data kontrak berhasil dihapus!');
    }
}
