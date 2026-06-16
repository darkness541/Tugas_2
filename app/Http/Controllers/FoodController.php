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

    public function destroy(Food $food)
    {
        $food->delete();
        return redirect()->route('foods.index')
            ->with('success', 'Menu berhasil dihapus');
    }
}