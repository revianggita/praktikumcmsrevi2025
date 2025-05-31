@extends('layouts.main')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Dashboard Inventaris</h1>
<a href="{{ route('dashboard.create') }}">Tambah Asset</a> 

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Kondisi</th>
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
