@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Transaksi</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('transactions.create') }}" class="btn btn-success mb-3">Tambah Transaksi</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Asset</th>
                <th>User</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->asset->name }}</td>
                    <td>{{ $transaction->user ? $transaction->user->email : '-' }}</td>
                    <td>{{ ucfirst($transaction->type) }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>{{ $transaction->date }}</td>
                    <td>
                        <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-info btn-sm">Detail</a>

                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus transaksi ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            @if($transactions->isEmpty())
                <tr>
                    <td colspan="7" class="text-center">Belum ada data transaksi.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
