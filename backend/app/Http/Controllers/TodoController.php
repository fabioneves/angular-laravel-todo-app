<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\TodoRequest;
use App\Todo;

class TodoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Todo::all(['id', 'text', 'done']);
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
        // New todo.
        $todo = new Todo();

        // Get the todo text from the request.
        $todo->text = $request->input('text');
        $todo->done = $request->input('done');

        // Try to save the todo in the database.
        try {
            $todo->save();
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

        // Todo was stored.
        return ['success' => true];
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
        $delete = Todo::destroy($id);
        return ['success' => (bool) $delete];
    }

}
