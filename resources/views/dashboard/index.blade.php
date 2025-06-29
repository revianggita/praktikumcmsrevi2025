@extends('layouts.main')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Dashboard Inventaris</h1>

<form method="POST" action="{{ route('logout') }}" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-danger btn-sm mb-3">Logout</button>
</form>

<a href="{{ route('dashboard.create') }}" class="btn btn-primary btn-sm mb-3">Tambah Asset</a>

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Kondisi</th>
            <th>Gambar</th> <!-- Tambahan -->
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($inventaris as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->category }}</td>
            <td>{{ $item->stock }}</td>
            <td>{{ $item->kondisi }}</td>
            <td>
                @if ($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" width="80" class="img-thumbnail" style="max-height: 100px;">
                @else
                    <span class="text-muted">Tidak ada</span>
                @endif
            </td>
            <td>
                <a href="{{ route('dashboard.show', $item->id) }}" class="btn btn-sm btn-info">Lihat</a>
                <a href="{{ route('dashboard.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('dashboard.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<a href="{{ route('dashboard.export.pdf') }}">Export PDF</a><br>
<!-- Tampilkan pagination -->
{{ $inventaris->links() }}
@endsection
