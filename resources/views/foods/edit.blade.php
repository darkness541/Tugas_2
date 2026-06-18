@extends('layouts.app')

@section('title', 'Edit Menu - NgabFood')

@section('content')
    <h2>Edit Menu: {{ $food->name }}</h2>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('foods.update', $food) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Restoran</label>
            <select name="restaurant_id" class="form-control" required>
                <option value="">Pilih Restoran</option>
                @foreach ($restaurants as $r)
                    <option value="{{ $r->id }}"
                        {{ old('restaurant_id', $food->restaurant_id) == $r->id ? 'selected' : '' }}>
                        {{ $r->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Menu</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $food->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga (Rp)</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $food->price) }}"
                step="0.01" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $food->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-warning">Update Menu</button>
        <a href="{{ route('foods.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
