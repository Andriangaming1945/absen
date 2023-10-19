<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Task;
use App\Models\TaskClassroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Auth::user()->hasRole('Wakasek') ? Task::latest()->get() : Task::whereNoId(Auth::user()->no_id)->latest()->get();
        $classrooms = Classroom::orderBy('name')->get();
        return view('task', [
            'title' => 'Tasks',
            'tasks' => $tasks,
            'classrooms' => $classrooms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'task_document' => 'required|file',
            'classrooms' => 'required|array'
        ]);

        if($validator->fails()){
            return back()->with('error', 'There was a problem adding.');
        }

        $validated = $validator->validated();

        $validated['user'] = Auth::user()->no_id;
        $file = $request->file('task_document')->store('file_uploads');
        $validated['task_document'] = $file;

        $task = Task::create(collect($validated)->forget('classrooms')->all());

        foreach($validated['classrooms'] as $classroom){
            TaskClassroom::create([
                'task_id' => $task->id,
                'classroom_id' => $classroom
            ]);
        }

        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'date' => 'required',
            'classrooms' => 'required|array'
        ];

        if($request->file('task_document')){
            $rules['task_document'] = 'required|file';
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return back()->with('error', 'There was a problem edit data.');
        }

        $validated = $validator->validated();
        $task = Task::findOrFail($id);

        if($request->file('task_document')){
            Storage::delete($task->task_document);
            $path_new_file =  $request->file('task_document')->store('file_uploads');
            $validated['task_document'] = $path_new_file;
        }

        $classroomsTask = [];

        foreach($task->task_classroom as $tc){
            $classroomsTask[] = $tc->classroom_id;
        }

        foreach($validated['classrooms'] as $classroom){
            if(!in_array($classroom, $classroomsTask)){
                TaskClassroom::create([
                    'task_id' => $task->id,
                    'classroom_id' => $classroom
                ]);
            }
        }

        foreach($classroomsTask as $tc){
            if(!in_array($tc, $validated['classrooms'])){
                TaskClassroom::where('classroom_id', $tc)->delete();
            }
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);

        TaskClassroom::whereTaskId($task->id)->delete();

        Storage::delete($task->task_document);

        $task->delete();

        return back();
    }
}
