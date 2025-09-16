<?php

namespace App\Http\Controllers;

use App\Models\RealisasiKontrak;
use App\Models\Kontrak;
use Illuminate\Http\Request;

class RealisasiController extends Controller
{
    public function index(Request $request)
    {
        $kontrak_id = $request->query('kontrak_id');
        if ($kontrak_id) {
            $kontrak = Kontrak::findOrFail($kontrak_id);
            $realisasis = RealisasiKontrak::where('kontrak_id', $kontrak_id)->paginate(10);
        } else {
            $kontrak = null;
            $realisasis = RealisasiKontrak::paginate(10);
        }
        return view('admin.realisasi.index', compact('kontrak', 'realisasis'));
    }

    public function create($kontrak_id = null)
    {
        if ($kontrak_id) {
            $kontrak = Kontrak::findOrFail($kontrak_id);
        } else {
            $kontrak = null;
        }
        return view('admin.realisasi.create', compact('kontrak'));
    }

    public function store(Request $request, $kontrak_id)
    {
        $validated = $request->validate([
            'no_pihak1' => 'required|string|max:255',
            'no_pihak2' => 'required|string|max:255',
            'tanggal_realisasi' => 'required|date',
            'jenis_kompensasi' => 'required|in:Pemeliharaan,Pembangunan',
            'deskripsi' => 'required|string',
            'nilai_kompensasi' => 'required|numeric|min:0',
            'lokasi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $validated['kontrak_id'] = $kontrak_id;

        if ($request->hasFile('dokumen')) {
            $validated['dokumen'] = $request->file('dokumen')->store('realisasi_dokumen', 'public');
        }

        RealisasiKontrak::create($validated);

        return redirect()->route('admin.realisasi.index', $kontrak_id)->with('success', 'Realisasi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $realisasi = RealisasiKontrak::with('kontrak')->findOrFail($id);
        return view('admin.realisasi.show', compact('realisasi'));
    }

    public function edit($id)
    {
        $realisasi = RealisasiKontrak::findOrFail($id);
        return view('admin.realisasi.edit', compact('realisasi'));
    }

    public function update(Request $request, $id)
    {
        $realisasi = RealisasiKontrak::findOrFail($id);

        $validated = $request->validate([
            'no_pihak1' => 'required|string|max:255',
            'no_pihak2' => 'required|string|max:255',
            'tanggal_realisasi' => 'required|date',
            'jenis_kompensasi' => 'required|in:Pemeliharaan,Pembangunan',
            'deskripsi' => 'required|string',
            'nilai_kompensasi' => 'required|numeric|min:0',
            'lokasi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('dokumen')) {
            $validated['dokumen'] = $request->file('dokumen')->store('realisasi_dokumen', 'public');
        }

        $realisasi->update($validated);

        return redirect()->route('admin.realisasi.index', $realisasi->kontrak_id)->with('success', 'Realisasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $realisasi = RealisasiKontrak::findOrFail($id);
        $kontrak_id = $realisasi->kontrak_id;
        $realisasi->delete();

        return redirect()->route('admin.realisasi.index', $kontrak_id)->with('success', 'Realisasi berhasil dihapus.');
    }
}
