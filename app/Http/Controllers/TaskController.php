<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = auth()->user()->projects->where("name", "!=", 'Today');

        return view("task.create", ["projects"=> $projects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $data = $request->validated();

        if(empty($data["project_id"])) {
            $inbox = auth()
            ->user()
            ->projects
            ->where("name", "Inbox")->first();

            $data["project_id"] = $inbox?->id;
        }

        if (! empty($data['due_date'])) {
            $data['due_date'] = Carbon::parse($data['due_date'])->toDateString();
        }

        Task::create($data);

        return redirect()->route("dashboard");
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
    public function edit(Task $task)
    {
        $user = auth()->user();
        $project = $task->project;

        if (!$project || $project->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $projects = $user->projects;

        return view("task.edit", ["task" => $task, "projects" => $projects]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        $data = $request->validated();

        // Handle due_date: parse if provided, set to null if empty
        if (isset($data['due_date']) && ! empty($data['due_date'])) {
            $data['due_date'] = Carbon::parse($data['due_date'])->toDateString();
        } else {
            $data['due_date'] = null;
        }

        $task->update($data);

        return redirect()->route("dashboard");
    }

    public function completed(Request $request, Task $task)
    {
        // Ensure the task belongs to a project owned by the authenticated user
        $user = auth()->user();
        $project = $task->project;

        if (!$project || $project->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $task->update([
            'is_completed' => $request->boolean('is_completed'),
        ]);

        return back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
