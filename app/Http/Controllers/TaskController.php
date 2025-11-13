<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
