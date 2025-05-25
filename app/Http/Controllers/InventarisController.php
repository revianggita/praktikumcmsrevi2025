<?php

namespace App\Http\Controllers;
use App\Models\Inventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function index()
    {
    // Mengambil semua data asset
    $inventaris = Inventaris::all();

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

        $inventaris->update($request->all());

        return redirect()->route('dashboard.index')->with('success', 'Asset updated successfully.');
    }


    public function destroy(Inventaris $inventaris)
    {
        $inventaris->delete();

        return redirect()->route('dashboard.index')->with('success', 'Asset deleted successfully.');
    }

}
