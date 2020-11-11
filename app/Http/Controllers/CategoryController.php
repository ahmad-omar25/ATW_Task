<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        Category::create([
            'name' => $request->input('name')
        ]);
        return redirect()->route('categories.index');
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
            ]);

            $category = Category::find($id);
            if (!$category) {
                return redirect()->route('categories.index');
            }
            $category->update($request->except('_token'));
            return redirect()->route('categories.index');
        } catch (\Exception $exception) {
            return redirect()->route('categories.index');
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('categories.index');
        }
        $category->delete();
        return redirect()->route('categories.index');
    }
}
