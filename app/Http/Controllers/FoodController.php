<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::with('restaurant')->get();
        return view('foods.index', compact('foods'));
    }

    public function create()
    {
        $restaurants = Restaurant::all();
        return view('foods.create', compact('restaurants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'name'          => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'description'   => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $food = Food::create([
                'restaurant_id' => $request->restaurant_id,
                'name'          => $request->name,
                'price'         => $request->price,
                'description'   => $request->description,
            ]);

            DB::commit();

            return redirect()->route('foods.index')
                ->with('success', 'Menu NgabFood berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menambahkan menu: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit(Food $food)
    {
        $restaurants = Restaurant::all();
        return view('foods.edit', compact('food', 'restaurants'));
    }

    public function update(Request $request, Food $food)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'name'          => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'description'   => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $food->update([
                'restaurant_id' => $request->restaurant_id,
                'name'          => $request->name,
                'price'         => $request->price,
                'description'   => $request->description,
            ]);

            DB::commit();

            return redirect()->route('foods.index')
                ->with('success', 'Menu NgabFood berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal memperbarui menu: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Food $food)
    {
        $food->delete();
        return redirect()->route('foods.index')
            ->with('success', 'Menu berhasil dihapus (Soft Delete)');
    }

    // Commit 5: Halaman Trash
    public function trash()
    {
        $trashedFoods = Food::onlyTrashed()->with('restaurant')->get();
        return view('foods.trash', compact('trashedFoods'));
    }

    // Commit 6: Restore Data
    public function restore($id)
    {
        DB::beginTransaction();
        try {
            $food = Food::onlyTrashed()->findOrFail($id);
            $food->restore();

            DB::commit();
            return redirect()->route('foods.trash')
                ->with('success', 'Menu berhasil direstore ke daftar utama!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal restore menu: ' . $e->getMessage());
        }
    }

    /**
     * Commit 7: Force Delete (Hapus Permanen)
     */
    public function forceDelete($id)
    {
        DB::beginTransaction();
        try {
            $food = Food::onlyTrashed()->findOrFail($id);
            $food->forceDelete();

            DB::commit();
            return redirect()->route('foods.trash')
                ->with('success', 'Menu berhasil dihapus permanen dari database!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menghapus permanen: ' . $e->getMessage());
        }
    }
}