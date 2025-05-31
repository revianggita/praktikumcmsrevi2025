<?php

namespace App\Http\Controllers;
use App\Models\Inventaris;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InventarisController extends Controller
{
    public function index()
    {
    // Mengambil Mengambil per 5 data
    $inventaris = Inventaris::paginate(5);

    // Mengirim data ke view
    return view('dashboard.index', compact('inventaris'));
    }


    public function create()
    {
        return view('dashboard.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'stock' => 'required|integer',
            'kondisi' => 'required',
        ]);

        $inventaris = Inventaris::create($request->all());


        return redirect()->route('dashboard.index')->with('success', 'Asset created successfully.');
    }


    public function edit(Inventaris $inventaris)
    {
        return view('dashboard.edit', compact('inventaris'));
    }

    public function update(Request $request, Inventaris $inventaris)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'stock' => 'required|integer',
            'kondisi' => 'required',
        ]);

        $inventaris->update($request->only(['name', 'category', 'stock', 'kondisi']));

        return redirect()->route('dashboard.index')->with('success', 'Asset updated successfully.');
    }


    public function destroy(Inventaris $inventaris)
    {
        $inventaris->delete();

        return redirect()->route('dashboard.index')->with('success', 'Asset deleted successfully.');
    }

    public function exportPdf()
    {
        $inventaris = Inventaris::all(); // atau Asset::all(); jika kamu gunakan model Asset
        $pdf = Pdf::loadView('dashboard.export_pdf', compact('inventaris'));
        return $pdf->download('laporan_inventaris.pdf');
    }

}
