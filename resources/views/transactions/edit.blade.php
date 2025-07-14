@extends('layouts.main')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Ubah Transaksi untuk "{{ $inventaris->name }}"</h1>

@if($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('transactions.update', $inventaris->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Barang</label>
        <input type="text" class="form-control" value="{{ $inventaris->name }}" readonly>
    </div>

    <div class="mb-3">
        <label>Stok Saat Ini</label>
        <input type="number" class="form-control" value="{{ $inventaris->stock }}" readonly>
    </div>

    <div class="mb-3">
        <label for="type">Jenis Transaksi</label>
        <select name="type" id="type" class="form-control" required>
            <option value="">-- Pilih --</option>
            <option value="masuk">Masuk</option>
            <option value="keluar">Keluar</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="quantity">Jumlah</label>
        <input type="number" name="quantity" id="quantity" class="form-control" required min="1">
    </div>

    <div class="mb-3">
        <label for="date">Tanggal</label>
        <input type="date" name="date" id="date" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
