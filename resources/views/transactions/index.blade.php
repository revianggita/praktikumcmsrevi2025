@extends('layouts.main')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Transaksi Inventaris</h1>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Kondisi</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($inventarisList as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->category }}</td>
            <td>{{ $item->stock }}</td>
            <td>{{ $item->kondisi }}</td>
            <td>
                @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" alt="Gambar" width="80">
                @else
                    Tidak ada gambar
                @endif
            </td>
            <td>
                <a href="{{ route('transactions.edit', $item->id) }}" class="btn btn-sm btn-warning">Ubah Transaksi</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
