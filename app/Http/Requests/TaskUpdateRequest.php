<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
{
    // Authorize only the owner
    public function authorize(): bool
    {
        $task = $this->route('task'); // Get task from route
        return $task && $task->project->user_id === $this->user()->id;
    }

    // Validation rules
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'project_id' => [
                'required',
                'exists:projects,id',
                function ($attribute, $value, $fail) {
                    $user = $this->user();
                    if (!$user->projects()->where('id', $value)->exists()) {
                        $fail('The selected project does not belong to you.');
                    }
                },
            ],
        ];
    }
}
