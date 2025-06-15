<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::all();
        return view('assets.index', compact('assets'));
    }

    public function create()
    {
        return view('assets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'stock' => 'required|integer',
            'unit' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'stock', 'unit']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('assets', 'public');
        }

        Asset::create($data);

        return redirect()->route('assets.index')->with('success', 'Asset created successfully.');
    }

    public function edit(Asset $asset)
    {
        return view('assets.edit', compact('asset'));
    }

    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'stock' => 'required|integer',
            'unit' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'stock', 'unit']);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($asset->image && \Storage::exists('public/' . $asset->image)) {
                \Storage::delete('public/' . $asset->image);
            }

            $data['image'] = $request->file('image')->store('assets', 'public');
        }

        $asset->update($data);

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully.');
    }

    public function destroy(Asset $asset)
    {
        // Hapus file gambar jika ada
        if ($asset->image && \Storage::exists('public/' . $asset->image)) {
            \Storage::delete('public/' . $asset->image);
        }

        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully.');
    }

}
