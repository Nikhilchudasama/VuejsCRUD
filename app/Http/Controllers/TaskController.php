<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskResourceCollection;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks =  Task::with('media')->get();
        return response()->json([
            'tasks'    => new TaskResourceCollection($tasks),
            'message' => 'Success'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $allowedMimeTypes = ['image/jpg','image/png','image/jpeg'];
        $this->validate($request, [
            'title'        => 'required|max:255',
            'description' => 'required',
        ]);
        $task = Task::create([
            'title'        => request('title'),
            'description' => request('description'),
        ]);
        $task->addMediaFromBase64(request()
                ->input('image'), $allowedMimeTypes)
                ->toMediaCollection('image');

        return response()->json([
            'task'    => new TaskResource($task),
            'message' => 'Success'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $allowedMimeTypes = ['image/jpg','image/png','image/jpeg'];
        $this->validate($request, [
            'title'        => 'required|max:255',
            'description' => 'required',
        ]);

        $task->title = request('title');
        $task->description = request('description');
        if (request('image')) {
            $task->addMediaFromBase64(request()
                ->input('image'), $allowedMimeTypes)
                ->toMediaCollection('image');
        }
        $task->save();

        return response()->json([
            'task' => new TaskResource($task),
            'message' => 'Task updated successfully!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json([
            'message' => 'Task deleted successfully!'
        ], 200);
    }
}
