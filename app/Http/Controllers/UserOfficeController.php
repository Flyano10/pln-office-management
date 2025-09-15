<?php

namespace App\Http\Controllers;

use App\Models\PlnOffice;
use App\Models\Gedung;
use App\Models\Operasional;
use App\Models\Kontrak;
use Illuminate\Http\Request;

class UserOfficeController extends Controller
{
    // List all offices with pagination and filtering
    public function index(Request $request)
    {
        $query = PlnOffice::query();

        if ($request->filled('office_type')) {
            $query->where('office_type', $request->office_type);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('office_name', 'like', '%' . $request->search . '%')
                    ->orWhere('city', 'like', '%' . $request->search . '%')
                    ->orWhere('province', 'like', '%' . $request->search . '%');
            });
        }

        $offices = $query->paginate(10)->appends($request->query());

        return view('user.offices.index', compact('offices'));
    }

    // Show office detail with tabs for Gedung and Operasional
    public function show($id)
    {
        $office = PlnOffice::with(['gedungs.kontrak', 'operasionals'])->findOrFail($id);

        // Load gedung and operasional related to this office
        $gedungs = $office->gedungs;
        $operasionals = $office->operasionals;

        // Decode keamanan JSON to array for each operasional
        foreach ($operasionals as $operasional) {
            if (is_string($operasional->keamanan)) {
                $operasional->keamanan = json_decode($operasional->keamanan, true);
            }
        }

        return view('user.offices.show', compact('office', 'gedungs', 'operasionals'));
    }

    // Show gedung detail with tab for kontrak
    public function gedungShow($id)
    {
        $gedung = Gedung::with('kontrak')->findOrFail($id);

        $kontraks = $gedung->kontrak;

        return view('user.gedung.show', compact('gedung', 'kontraks'));
    }
}
