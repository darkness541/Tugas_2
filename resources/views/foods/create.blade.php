@extends('layouts.app')

@section('title', 'Tambah Menu - NgabFood')

@section('content')
    <h2>Tambah Menu Baru</h2>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('foods.store') }}" method="POST">
        @csrf
        <!-- form inputs seperti sebelumnya -->
        <div class="mb-3">
            <label>Restoran</label>
            <select name="restaurant_id" class="form-control" required>
                <option value="">Pilih Restoran</option>
                @foreach ($restaurants as $r)
                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Nama Menu</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label>Harga (Rp)</label>
            <input type="number" name="price" class="form-control" value="{{ old('price') }}" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
@endsection
