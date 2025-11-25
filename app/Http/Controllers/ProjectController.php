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
    public function index(Request $request)
    {
        $user = auth()->user();

        $search = $request->input('search');

        $query = $user->projects()
            ->where('name', '!=', 'Inbox')
            ->where('name', '!=', 'Today');

        if (! empty($search)) {
            $query = $query->where('name', 'like', '%'.$search.'%');
        }

        $projects = $query
            ->latest()
            ->get();

        return view('project.projects', [
            'projects' => $projects,
            'search' => $search]);
    }

    public function inbox()
    {
        $user = auth()->user();
        $filter = $this->normalizeFilter(request()->query('filter'));

        $project = $user->projects()->where('name', 'Inbox')->first();

        $tasks = collect();

        if ($project) {
            $tasks = $project->tasks()
                ->orderByDesc('created_at')
                ->when($filter === 'active', fn ($q) => $q->where('is_completed', false))
                ->when($filter === 'completed', fn ($q) => $q->where('is_completed', true))
                ->get();
        }

        return view('project.project', [
            'project' => $project,
            'tasks' => $tasks,
            'filter' => $filter,
        ]);
    }


    public function today()
    {
        $user = auth()->user();

        // Get Today project
        $project = $user->projects()->where('name', 'Today')->first();

        // Selected filter: null | active | completed
        $filter = $this->normalizeFilter(request()->query('filter'));

        // Get Today-project tasks
        $tasks = $project?->tasks ?? collect();

        // All tasks of all user projects
        $allUserTasks = $user->projects()
            ->with('tasks')
            ->get()
            ->pluck('tasks')
            ->flatten();

        // Tasks due today
        $dueToday = $allUserTasks->filter(function ($task) {
            return $task->due_date?->isToday();
        });

        // Merge Today tasks + due_today tasks and remove duplicates
        $tasks = $tasks->merge($dueToday)->unique('id');

        // Apply filter
        if ($filter === 'active') {
            $tasks = $tasks->filter(fn ($t) => ! $t->is_completed);
        } elseif ($filter === 'completed') {
            $tasks = $tasks->filter(fn ($t) => $t->is_completed);
        }

        return view('project.project', [
            'project' => $project,
            'tasks' => $tasks,
            'filter' => $filter, // ← IMPORTANT
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectStoreRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();

        Project::create($data);

        return redirect()->route('project.projects');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $user = auth()->user();

        $filter = $this->normalizeFilter(request()->query('filter'));

        $project = $user->projects()->findOrFail($project->id);

        $tasks = $project->tasks()
            ->orderByDesc('created_at')
            ->when($filter === 'active', fn ($q) => $q->where('is_completed', false))
            ->when($filter === 'completed', fn ($q) => $q->where('is_completed', true))
            ->get();

        return view('project.project', [
            'project' => $project,
            'tasks' => $tasks,
            'filter' => $filter,
        ]);
    }

    protected function normalizeFilter(?string $filter): ?string
    {
        return in_array($filter, ['active', 'completed'], true) ? $filter : null;
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
