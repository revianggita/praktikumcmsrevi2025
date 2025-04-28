@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Transaksi</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Asset: {{ $transaction->asset->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">User: {{ $transaction->user ? $transaction->user->email : '-' }}</h6>
            <p class="card-text">
                <strong>Jenis Transaksi:</strong> {{ ucfirst($transaction->type) }}<br>
                <strong>Jumlah:</strong> {{ $transaction->quantity }}<br>
                <strong>Tanggal:</strong> {{ $transaction->date }}
            </p>
            <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
