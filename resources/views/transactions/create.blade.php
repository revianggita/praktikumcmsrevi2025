@extends('layouts.main')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Tambah Transaksi Inventaris</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('transactions.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="inventaris_id" class="form-label">Pilih Inventaris</label>
        <select name="inventaris_id" id="inventaris_id" class="form-control" required>
            <option value="">-- Pilih --</option>
            @foreach($inventarisList as $item)
                <option value="{{ $item->id }}">{{ $item->name }} - Stok: {{ $item->stock }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="user_id" class="form-label">Pengguna</label>
        <select name="user_id" id="user_id" class="form-control" required>
            <option value="">-- Pilih --</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="type" class="form-label">Jenis Transaksi</label>
        <select name="type" id="type" class="form-control" required>
            <option value="">-- Pilih --</option>
            <option value="masuk">Masuk</option>
            <option value="keluar">Keluar</option>
            <option value="rusak">Rusak</option>
            <option value="pindah">Pindah</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="quantity" class="form-label">Jumlah</label>
        <input type="number" name="quantity" class="form-control" min="1" required>
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Tanggal</label>
        <input type="date" name="date" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
