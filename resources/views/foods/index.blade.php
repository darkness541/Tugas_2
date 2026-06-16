@extends('layouts.app')

@section('title', 'Daftar Menu - NgabFood')

@section('content')
    <h1>Daftar Menu NgabFood</h1>

    <a href="{{ route('foods.create') }}" class="btn btn-primary mb-3">+ Tambah Menu Baru</a>

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
            @foreach ($foods as $food)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $food->name }}</td>
                    <td>Rp {{ number_format($food->price ?? 0, 0) }}</td>
                    <td>{{ $food->restaurant->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('foods.edit', $food) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('foods.destroy', $food) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
