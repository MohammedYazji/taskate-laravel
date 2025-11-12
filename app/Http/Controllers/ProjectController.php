<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $projects = auth()->user()->projects()->latest()->get();

        // dump($projects);

        // return view("projects.index", ["projects"=> $projects]);
    }

    public function inbox()
    {
        $user = auth()->user();

        // Get Inbox Project fot the logged-in user
        $inbox = $user->projects()->where("name", "Inbox")->first();

        return view("project.inbox", ["inbox" => $inbox]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("project.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectStoreRequest $request)
    {
        $data = $request->validated();

        $data["user_id"] = auth()->id();

        Project::create($data);

        return redirect()->route("dashboard");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
