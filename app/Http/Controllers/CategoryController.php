<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();

        return view('categories.index', compact('categories'));
    }


    public function create()
    {
        return view('categories.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:100']
        ]);

        Category::create([
            'name' => $validated['name'],
            'user_id' => Auth::id()
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success','Categoria criada com sucesso.');
    }


    public function edit($id)
    {
        $category = Category::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('categories.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:100']
        ]);

        $category = Category::where('user_id', Auth::id())
            ->findOrFail($id);

        $category->update([
            'name' => $validated['name']
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success','Categoria atualizada.');
    }


    public function destroy($id)
    {
        $category = Category::where('user_id', Auth::id())
            ->findOrFail($id);

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success','Categoria removida.');
    }
}
