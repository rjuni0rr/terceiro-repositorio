<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;
use Illuminate\Support\Facades\Crypt;

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


    public function createTask()
    {
        $categories = Category::where('is_system', true)
            ->orWhere('user_id', auth()->id())->orderBy('name')->get();

        return view('main.task_create_frm', compact('categories'));
    }


    public function createTaskSubmit(Request $request)
    {

        $request->validate(
            [
                'name' => 'required|max:255',
                'category_id' => 'nullable|exists:categories,id',
                'urgency' => 'required|in:low,medium,high'
            ],
            [
                'name.required' => 'O nome de usuário é obrigatório',
                'name.max' => 'O nome de usuário deve ter no máximo 255 caracteres.',

                'urgency.required' => 'O campo de urgência é obrigatório.'
            ]
        );

        Task::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'urgency' => $request->urgency
        ]);

        return redirect()->route('tasks.index')->with('success','Task criada com sucesso');
    }


    public function editTask($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $task = Task::where('id',$id)->where('user_id',auth()->id())->firstOrFail();
        $categories = Category::where('is_system', true)->orWhere('user_id', auth()->id())->orderBy('name')->get();

        return view('main.task_edit_frm', compact('task','categories'));
    }


    public function editTaskSubmit(Request $request, $id)
    {
        // desencripta o id
        try {
            $id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(403, 'ID de fila inválido');
        }

        $task = Task::where('id',$id)
            ->where('user_id',auth()->id())
            ->firstOrFail();

        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'urgency' => 'required|in:low,medium,high'
        ]);

        $task->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'urgency' => $request->urgency
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success','Task atualizada');

    }


    public function deleteTask($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $task = Task::where('id',$id)
            ->where('user_id',auth()->id())
            ->firstOrFail();

        return view('main.task_delete', compact('task'));
    }


    public function deleteTaskConfirm($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $task = Task::where('id',$id)
            ->where('user_id',auth()->id())
            ->firstOrFail();

        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success','Task excluída com sucesso');
    }






//
//
//    public function edit($id)
//    {
//        $task = Task::where('user_id', Auth::id())
//            ->findOrFail($id);
//
//        $categories = Category::where('user_id', Auth::id())
//            ->orderBy('name')
//            ->get();
//
//        return view('tasks.edit', compact('task','categories'));
//    }
//
//
//    public function update(Request $request, $id)
//    {
//        $validated = $request->validate([
//            'name' => ['required','string','max:255'],
//            'description' => ['nullable','string'],
//            'category_id' => ['required','exists:categories,id'],
//            'urgency' => ['required','in:low,medium,high']
//        ]);
//
//        $task = Task::where('user_id', Auth::id())
//            ->findOrFail($id);
//
//        $task->update([
//            'name' => $validated['name'],
//            'description' => $validated['description'],
//            'category_id' => $validated['category_id'],
//            'urgency' => $validated['urgency']
//        ]);
//
//        return redirect()
//            ->route('tasks.index')
//            ->with('success','Task atualizada com sucesso.');
//    }
//
//
//    public function destroy($id)
//    {
//        $task = Task::where('user_id', Auth::id())
//            ->findOrFail($id);
//
//        $task->delete();
//
//        return redirect()
//            ->route('tasks.index')
//            ->with('success','Task removida.');
//    }

}
