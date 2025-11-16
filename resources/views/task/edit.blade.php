<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold mb-8">Edit Task</h1>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl p-10">
                <form action="{{ route('task.update', $task) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    {{-- Name --}}
                    <div class="mb-6">
                        <x-input-label for="name" :value="'Task Name'" />
                        <input type="text" name="name" value="{{ old('name', $task->name) }}"
                            class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Description --}}
                    <div class="mb-6">
                        <x-input-label for="description" :value="'Description'" />
                        <textarea name="description" rows="5" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm">{{ old('description', $task->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    {{-- Due Date --}}
                    <div class="mb-6">
                        <x-input-label for="due_date" :value="'Due Date'" />
                        <input type="date" name="due_date" value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                            class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm">
                        <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                    </div>

                    {{-- Project --}}
                    <div class="mb-6">
                        <x-input-label for="project_id" :value="'Project'" />
                        <select name="project_id" id="project_id" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm">
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" @selected($task->project_id == $project->id)>{{ $project->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('project_id')" class="mt-2" />
                    </div>

                    <x-primary-button>Update Task</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
