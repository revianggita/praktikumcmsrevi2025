@extends('layouts.main')

@section('content')
    <h2 class="mb-3">Detail Inventaris</h2>
    <ul>
        <li><strong>Nama:</strong> {{ $inventaris->name }}</li>
        <li><strong>Kategori:</strong> {{ $inventaris->category }}</li>
        <li><strong>Stok:</strong> {{ $inventaris->stock }}</li>
        <li><strong>Kondisi:</strong> {{ $inventaris->kondisi }}</li>
        @if ($inventaris->image)
            <li><strong>Gambar:</strong><br>
                <img src="{{ asset('storage/' . $inventaris->image) }}" width="150">
            </li>
        @endif
    </ul>
    <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
