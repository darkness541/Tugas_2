@extends('layouts.app')

@section('title', 'Trash - Menu NgabFood')

@section('content')
    <h2>🗑 Tong Sampah Menu NgabFood</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($trashedFoods->isEmpty())
        <div class="alert alert-info">Tidak ada data yang dihapus.</div>
    @else
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Restoran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trashedFoods as $food)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $food->name }}</td>
                        <td>Rp {{ number_format($food->price, 0) }}</td>
                        <td>{{ $food->restaurant->name ?? '-' }}</td>
                        <td>
                            <form action="{{ route('foods.restore', $food->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>

                            <form action="{{ route('foods.forceDelete', $food->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus permanen? Data tidak bisa dikembalikan!')">
                                    Force Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('foods.index') }}" class="btn btn-primary">Kembali ke Daftar Menu</a>
@endsection
