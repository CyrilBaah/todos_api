<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /*TODO: Use a service here */
    private const ERROR = 'Something went wrong';
    private const INVALID_ID_ERR = 'Invalid id bro';

    public function index()
    {
        try {
            return Todo::all();
        } catch (\Exception $e) {
            return $this::ERROR;
        }
    }

    public function create(Request $request)
    {
        try {
            return Todo::create(
                [
                    'title' => $request->title,
                    'status' => $request->status ?? 0
                ]
            );
        } catch (\Exception $e) {
            return $this::ERROR;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $todoToUpdate =  Todo::find($id);
            if (!$todoToUpdate) {
                return $this::INVALID_ID_ERR;
            }

            $todoToUpdate->title = $request->title ?? $todoToUpdate->title;
            $todoToUpdate->status = $request->status ?? $todoToUpdate->status;

            return $todoToUpdate->save() ? Todo::find($id) : 'update failed bro';
        } catch (\Exception $e) {
            return $this::ERROR;
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $requestedTodo = Todo::find($id);
            return $requestedTodo ? $requestedTodo : $this::INVALID_ID_ERR;
        } catch (\Exception $e) {
            return $this::ERROR;
        }
    }

    public function destroy($id)
    {
        try {
            $todoToDelete = Todo::find($id);

            if (!$todoToDelete) {
                return $this::INVALID_ID_ERR;
            }
            $todoToDelete->delete();
            return $todoToDelete;
        } catch (\Exception $e) {
            return $this::ERROR;
        }
    }
}
