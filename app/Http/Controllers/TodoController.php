<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AddTodoForm;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Todo::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AddTodoForm  $request
     * @return Response
     */
    public function store(AddTodoForm $request)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
