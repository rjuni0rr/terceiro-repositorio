<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->with('category')
            ->orderBy('created_at','desc')
            ->get();

        return view('main.index', compact('tasks'));
    }


    public function create()
    {
        $categories = Category::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();

        return view('tasks.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'category_id' => ['required','exists:categories,id'],
            'urgency' => ['required','in:low,medium,high']
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'description' => $validated['description'],
            'urgency' => $validated['urgency']
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success','Task criada com sucesso.');
    }


    public function edit($id)
    {
        $task = Task::where('user_id', Auth::id())
            ->findOrFail($id);

        $categories = Category::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();

        return view('tasks.edit', compact('task','categories'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'category_id' => ['required','exists:categories,id'],
            'urgency' => ['required','in:low,medium,high']
        ]);

        $task = Task::where('user_id', Auth::id())
            ->findOrFail($id);

        $task->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'urgency' => $validated['urgency']
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success','Task atualizada com sucesso.');
    }


    public function destroy($id)
    {
        $task = Task::where('user_id', Auth::id())
            ->findOrFail($id);

        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success','Task removida.');
    }

}
