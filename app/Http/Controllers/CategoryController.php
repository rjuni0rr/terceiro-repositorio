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


    public function createCategorySubmit(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255'
            ],
            [
                'name.required' => 'O nome de usuário é obrigatório',
                'name.max' => 'O nome de usuário deve ter no máximo 255 caracteres.',
            ]
        );

        Category::create([

            'name' => $request->name,
            'user_id' => auth()->id(),
            'is_system' => false

        ]);

        return back()->with('success','Categoria criada');

    }


}
