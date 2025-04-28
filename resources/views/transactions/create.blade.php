@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Transaksi</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada masalah dengan inputanmu.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="asset_id" class="form-label">Pilih Asset</label>
            <select class="form-control" name="asset_id" id="asset_id" required>
                @foreach($assets as $asset)
                    <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">Pilih User</label>
            <select class="form-control" name="user_id" id="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->email }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Jenis Transaksi</label>
            <select class="form-control" name="type" id="type" required>
                <option value="masuk">Masuk</option>
                <option value="keluar">Keluar</option>
                <option value="rusak">Rusak</option>
                <option value="pindah">Pindah</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah</label>
            <input type="number" name="quantity" class="form-control" id="quantity" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Tanggal</label>
            <input type="date" name="date" class="form-control" id="date" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
