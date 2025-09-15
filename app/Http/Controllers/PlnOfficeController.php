<?php

namespace App\Http\Controllers;

use App\Models\PlnOffice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PlnOfficeController extends Controller
{
    // Halaman user (public)
    public function userIndex(Request $request)
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

    // Peta untuk user
    public function userMap()
    {
        $offices = PlnOffice::all();
        $officeColors = [
            'Pusat' => '#e74c3c',
            'SBU' => '#3498db',
            'KP' => '#2ecc71',
            'default' => '#95a5a6'
        ];
        $cities = PlnOffice::distinct('city')->pluck('city')->sort();
        $provinces = PlnOffice::distinct('province')->pluck('province')->sort();
        return view('user.offices.map', compact('offices', 'officeColors', 'cities', 'provinces'));
    }

    // Admin index method for managing offices
    public function index()
    {
        $offices = PlnOffice::paginate(10);
        $officeTypes = [
            'Pusat' => 'Kantor Pusat',
            'SBU' => 'SBU',
            'KP' => 'Kantor Perwakilan'
        ];
        return view('admin.office.index', compact('offices', 'officeTypes'));
    }

    public function show(PlnOffice $office)
    {
        return view('admin.office.show', compact('office'));
    }

    public function create()
    {
        $officeTypes = [
            'Pusat' => 'Kantor Pusat',
            'SBU' => 'SBU',
            'KP' => 'Kantor Perwakilan'
        ];
        $offices = PlnOffice::all(); // for parent selection

        return view('admin.office.create', compact('officeTypes', 'offices'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'office_id' => 'required|string|unique:pln_offices,office_id',
            'office_name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'office_type' => 'required|in:Pusat,SBU,KP',
            'parent_office' => 'nullable|integer|exists:pln_offices,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        PlnOffice::create($validator->validated());

        return redirect()->route('admin.offices.index')->with('success', 'Kantor berhasil ditambahkan!');
    }

    public function edit(PlnOffice $office)
    {
        $officeTypes = [
            'Pusat' => 'Kantor Pusat',
            'SBU' => 'SBU',
            'KP' => 'Kantor Perwakilan'
        ];
        $offices = PlnOffice::where('id', '!=', $office->id)->get(); // for parent selection, exclude self

        return view('admin.office.edit', compact('office', 'officeTypes', 'offices'));
    }

    public function update(Request $request, PlnOffice $office)
    {
        $validator = Validator::make($request->all(), [
            'office_id' => 'required|string|unique:pln_offices,office_id,' . $office->id,
            'office_name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'office_type' => 'required|in:Pusat,SBU,KP',
            'parent_office' => 'nullable|integer|exists:pln_offices,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $office->update($data);

        return redirect()->route('admin.offices.index')->with('success', 'Kantor berhasil diupdate!');
    }

    public function destroy(PlnOffice $office)
    {
        $office->delete();

        return redirect()->route('admin.offices.index')->with('success', 'Kantor berhasil dihapus!');
    }

    public function mapView()
    {
        $offices = PlnOffice::all();
        return view('admin.office.map', compact('offices'));
    }
}
