@extends('layouts.app')

@section('title', 'Daftar Menu - NgabFood')

@section('content')
    <h1>Daftar Menu NgabFood</h1>

    <a href="{{ route('foods.create') }}" class="btn btn-primary mb-3">Tambah Menu Baru</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($foods as $food)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $food->name }}</td>
                    <td>Rp {{ number_format($food->price ?? 0, 0) }}</td>
                    <td>
                        <!-- Aksi Edit & Delete -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
