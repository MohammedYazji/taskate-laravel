<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold text-gray-800 mb-8">
                Create New Task
            </h1>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl p-10">
                <form action="{{ route('task.store') }}" method="post" enctype="multipart/form-data">

                    @csrf

                    {{-- Name --}}
                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Task Name')" />
                        <input
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-600 focus:ring-indigo-600 rounded-lg shadow-sm"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                        >
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <!-- Project Id -->
                    <div class="mt-4">
                        <x-input-label for="project_id" :value="__('Project')" />
                        <select id="project_id" name="project_id"
                            class=" mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full">
                            <option value="">Select a Project</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}" @selected(old('project_id') == $project->id)>{{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('project_id')" class="mt-2" />
                    </div>
                    {{-- Description  --}}
                    <div class="mb-6">
                        <x-input-label for="description" :value="__('Description')" />
                        <x-textarea-input
                            id="description"
                            class="block mt-1 w-full"
                            name="description"
                            autofocus
                            rows="6"
                        />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    {{-- Due Date --}}
                    <div class="mb-6">
                        <x-input-label for="due_date" :value="__('Due date')" />
                        <x-text-input
                            id="due_date"
                            class="block mt-1 w-full"
                            type="date"
                            name="due_date"
                            :value="old('due_date')"
                        />
                        <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex justify-end pt-4 border-t border-gray-100">
                        <x-primary-button>
                            Create Task
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
