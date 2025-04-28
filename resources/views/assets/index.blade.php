@extends('layouts.app')

@section('content')
    <h1>Daftar Asset</h1>
    <a href="{{ route('assets.create') }}">Tambah Asset</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Unit</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assets as $asset)
                <tr>
                    <td>{{ $asset->name }}</td>
                    <td>{{ $asset->category }}</td>
                    <td>{{ $asset->stock }}</td>
                    <td>{{ $asset->unit }}</td>
                    <td>
                        <a href="{{ route('assets.edit', $asset->id) }}">Edit</a>
                        <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
