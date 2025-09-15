<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\PlnOffice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GedungController extends Controller
{
    public function index()
    {
        $gedungs = Gedung::with('kantor')->paginate(10);
        return view('admin.gedung.index', compact('gedungs'));
    }

    public function create()
    {
        $kantors = PlnOffice::all();
        return view('admin.gedung.create', compact('kantors'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kantor_id' => 'required|exists:pln_offices,id',
            'luas_bangunan' => 'required|numeric|min:0',
            'jumlah_lantai' => 'required|integer|min:1',
            'jumlah_ruangan' => 'required|integer|min:1',
            'fasilitas_utama' => 'nullable|string',
            'status_gedung' => 'required|in:Milik,Sewa,Hibah,Layanan'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        // Convert fasilitas_utama string to JSON array
        $data['fasilitas_utama'] = json_encode(array_map('trim', explode(',', $request->fasilitas_utama ?? '')));

        Gedung::create($data);

        return redirect()->route('admin.gedung.index')->with('success', 'Gedung berhasil ditambahkan!');
    }

    public function show(Gedung $gedung)
    {
        $gedung->load('kantor', 'kontraks');
        return view('admin.gedung.show', compact('gedung'));
    }

    public function edit(Gedung $gedung)
    {
        $kantors = PlnOffice::all();
        return view('admin.gedung.edit', compact('gedung', 'kantors'));
    }

    public function update(Request $request, Gedung $gedung)
    {
        $validator = Validator::make($request->all(), [
            'kantor_id' => 'required|exists:pln_offices,id',
            'luas_bangunan' => 'required|numeric|min:0',
            'jumlah_lantai' => 'required|integer|min:1',
            'jumlah_ruangan' => 'required|integer|min:1',
            'fasilitas_utama' => 'nullable|array',
            'status_gedung' => 'required|in:Milik,Sewa,Hibah,Layanan'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data['fasilitas_utama'] = json_encode($request->fasilitas_utama ?? []);

        $gedung->update($data);

        return redirect()->route('admin.gedung.index')->with('success', 'Gedung berhasil diupdate!');
    }

    public function destroy(Gedung $gedung)
    {
        $gedung->delete();
        return redirect()->route('admin.gedung.index')->with('success', 'Gedung berhasil dihapus!');
    }
}
