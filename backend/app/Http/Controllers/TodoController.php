<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\TodoRequest;
use App\Todo;
use Illuminate\Support\Facades\Cache;

class TodoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $todos = Cache::rememberForever('todos.all', function () {
            return Todo::all(['id', 'text', 'done']);
        });
        return $todos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TodoRequest $request
     *
     * @return Response
     */
    public function store(TodoRequest $request)
    {
        // Try to save the todo in the database.
        try {
            // New todo.
            $todo = Todo::create([
              'text' => $request->input('text'),
              'done' => $request->input('done')
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

        // Clear cache.
        Cache::forget('todos.all');

        // Todo was stored.
        return ['success' => true, 'id' => $todo->id];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TodoRequest $request
     * @param  int         $id
     *
     * @return Response
     */
    public function update(TodoRequest $request, $id)
    {
        // Get todo from the database.
        $todo = Todo::find($id);

        // Check if we have a todo, if yes, modify it.
        if (!empty($todo)) {

            // Get the todo details from the request.
            $todo->text = $request->input('text');
            $todo->done = $request->input('done');

            // Try to save the todo in the database.
            try {
                $todo->save();
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }

            // Clear cache.
            Cache::forget('todos.all');

            // Todo was saved.
            return ['success' => true];
        }

        // Todo not found.
        return ['success' => false, 'message' => 'Todo not found.'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        // Delete an item.
        $delete = Todo::destroy($id);

        // Clear cache if the item is deleted.
        if ($delete) {
            Cache::forget('todos.all');
        }

        // Returns response.
        return ['success' => (bool) $delete];
    }

    /**
     * Remove all the completed todos from the storage.
     *
     * @return Response
     */
    public function postDestroyCompleted()
    {
        // Delete an item.
        $delete = Todo::where('done', 1)->delete();

        // Clear cache if the item is deleted.
        if ($delete) {
            Cache::forget('todos.all');
        }

        // Returns response.
        return ['success' => (bool) $delete];
    }

}
