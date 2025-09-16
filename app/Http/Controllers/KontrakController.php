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
            'nama_perjanjian' => 'required|string|max:255',
            'no_perjanjian_pihak1' => 'required|string|max:255',
            'no_perjanjian_pihak2' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'sbu' => 'required|string|max:255',
            'ruang_lingkup' => 'required|string|max:255',
            'asset_owner' => 'required|string|max:255',
            'peruntukan' => 'required|in:Kantor SBU,Kantor KP,Gudang',
            'alamat' => 'required|string',
            'status' => 'required|in:baru,berjalan,selesai,amandemen',
            'gedung_id' => 'required|exists:gedungs,id',
        ]);

        Kontrak::create($validated);

        return redirect()->route('admin.kontrak.index')->with('success', 'Kontrak berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kontrak = Kontrak::with('gedung', 'realisasiKontrak')->findOrFail($id);
        return view('admin.kontrak.show', compact('kontrak'));
    }

    public function edit($id)
    {
        $kontrak = Kontrak::findOrFail($id);
        $gedungs = Gedung::all();
        return view('admin.kontrak.edit', compact('kontrak', 'gedungs'));
    }

    public function update(Request $request, $id)
    {
        $kontrak = Kontrak::findOrFail($id);

        $validated = $request->validate([
            'nama_perjanjian' => 'required|string|max:255',
            'no_perjanjian_pihak1' => 'required|string|max:255',
            'no_perjanjian_pihak2' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'sbu' => 'required|string|max:255',
            'ruang_lingkup' => 'required|string|max:255',
            'asset_owner' => 'required|string|max:255',
            'peruntukan' => 'required|in:Kantor SBU,Kantor KP,Gudang',
            'alamat' => 'required|string',
            'status' => 'required|in:baru,berjalan,selesai,amandemen',
            'gedung_id' => 'required|exists:gedungs,id',
        ]);

        $kontrak->update($validated);

        return redirect()->route('admin.kontrak.index')->with('success', 'Kontrak berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kontrak = Kontrak::findOrFail($id);
        $kontrak->delete();

        return redirect()->route('admin.kontrak.index')->with('success', 'Kontrak berhasil dihapus.');
    }
}
