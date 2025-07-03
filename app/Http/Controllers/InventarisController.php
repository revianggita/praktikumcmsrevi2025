<?php

namespace App\Http\Controllers;
use App\Models\Inventaris;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class InventarisController extends Controller
{
    public function index()
    {
    // Mengambil Mengambil per 4 data
    $inventaris = Inventaris::orderBy('created_at', 'desc')->paginate(4);

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
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'stock', 'kondisi']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('inventaris', 'public');
            $data['image'] = $imagePath; // ini yang masuk ke kolom `image`
        }

        Inventaris::create($data);

        Log::info('Berhasil menyimpan data inventaris', ['data' => $data]);

        return redirect()->route('dashboard.index')->with('success', 'Asset created successfully.');
    }


    public function edit($id)
{
    $inventaris = Inventaris::findOrFail($id);
    return view('dashboard.edit', compact('inventaris'));
}

public function update(Request $request, $id)
{
    $inventaris = Inventaris::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'category' => 'required',
        'stock' => 'required|integer',
        'kondisi' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only(['name', 'category', 'stock', 'kondisi']);

    if ($request->hasFile('image')) {
        // Hapus gambar lama
        if ($inventaris->image && Storage::exists('public/' . $inventaris->image)) {
            Storage::delete('public/' . $inventaris->image);
        }
        // Simpan gambar baru
        $data['image'] = $request->file('image')->store('inventaris', 'public');
    }

    $inventaris->update($data);

    Log::info('Berhasil update data inventaris', ['data' => $data]);

    return redirect()->route('dashboard.index')->with('success', 'Asset updated successfully.');
}




    public function destroy($id)
    {
        $inventaris = Inventaris::findOrFail($id);

        if ($inventaris->image && Storage::exists('public/' . $inventaris->image)) {
            Storage::delete('public/' . $inventaris->image);
        }

        $inventaris->delete();

        return redirect()->route('dashboard.index')->with('success', 'Asset deleted successfully');
    }


    public function exportPdf()
    {
        $inventaris = Inventaris::all(); // atau Asset::all(); jika kamu gunakan model Asset
        $pdf = Pdf::loadView('dashboard.export_pdf', compact('inventaris'));
        return $pdf->download('laporan_inventaris.pdf');
    }

    public function show($id)
    {
        try {
            $inventaris = Inventaris::findOrFail($id);

            Log::info('Berhasil membuka data inventaris', ['id' => $id]);

            return view('dashboard.show', compact('inventaris'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Gagal menemukan data inventaris', ['id' => $id, 'error' => $e->getMessage()]);

            return redirect()->route('dashboard.index')->with('error', 'Data tidak ditemukan.');
        }
    }


}
