<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Asset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
    <div class="container">
        <h1 class="mb-4">Edit Data Asset</h1>
        
                <!-- Pesan sukses -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('dashboard.update', $inventaris) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $inventaris->name) }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <input type="text" name="category" class="form-control" id="category" value="{{ old('category', $inventaris->category) }}">
                        @error('category')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stok</label>
                        <input type="number" name="stock" class="form-control" id="stock" value="{{ old('stock', $inventaris->stock) }}">
                        @error('stock')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kondisi" class="form-label">Kondisi</label>
                        <input type="text" name="kondisi" class="form-control" id="kondisi" value="{{ old('kondisi', $inventaris->kondisi) }}">
                        @error('kondisi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Gambar Baru (opsional)</label>
                        <input type="file" name="image" class="form-control" id="image">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @if ($inventaris->image)
                        <div class="mb-3">
                            <label class="form-label">Gambar Lama:</label><br>
                            <img src="{{ asset('storage/' . $inventaris->image) }}" width="120">
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
    </div>
</body>
</html>
