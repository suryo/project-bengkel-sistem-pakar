<?php

namespace App\Http\Controllers;

use App\Models\SparePart;
use App\Models\Category;
use Illuminate\Http\Request;

class SparePartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $spareParts = SparePart::with('category')->latest()->paginate(10);
        return view('spare_parts.index', compact('spareParts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('spare_parts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        SparePart::create($request->all());

        return redirect()->route('spare-parts.index')
            ->with('success', 'Spare Part created successfully.');
    }

    public function show(SparePart $sparePart)
    {
        return view('spare_parts.show', compact('sparePart'));
    }

    public function edit(SparePart $sparePart)
    {
        $categories = Category::all();
        return view('spare_parts.edit', compact('sparePart', 'categories'));
    }

    public function update(Request $request, SparePart $sparePart)
    {
        $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $sparePart->update($request->all());

        return redirect()->route('spare-parts.index')
            ->with('success', 'Spare Part updated successfully.');
    }

    public function destroy(SparePart $sparePart)
    {
        $sparePart->delete();

        return redirect()->route('spare-parts.index')
            ->with('success', 'Spare Part deleted successfully.');
    }
}
