@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Asset</h2>

    <!-- Menampilkan pesan sukses jika ada -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Menampilkan error validasi jika ada -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('assets.update', $asset->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Menandakan bahwa ini adalah request PUT untuk update -->

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $asset->name) }}" required>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $asset->category) }}" required>
        </div>

        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $asset->stock) }}" required>
        </div>

        <div class="form-group">
            <label for="unit">Unit</label>
            <input type="text" class="form-control" id="unit" name="unit" value="{{ old('unit', $asset->unit) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Asset</button>
        <a href="{{ route('assets.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
