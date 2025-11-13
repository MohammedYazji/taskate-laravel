<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-extrabold mb-10"> {{ $project->name }}</h1>
                    <ul class="space-y-4">
                        @forelse ($tasks as $task)
                            <li class="border border-gray-100 rounded-lg">
                                <form method="POST"
                                    class="flex items-start gap-4 p-4">
                                    @csrf
                                    @method('PATCH')

                                    <input type="hidden" name="is_completed" value="0">

                                    <input type="checkbox" name="is_completed" value="1"
                                        @checked($task->is_completed) onchange="this.form.submit()"
                                        aria-label="Toggle completion for {{ $task->name }}"
                                        class="mt-1 h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                    <div class="flex flex-col gap-1">
                                        <span @class([
                                            'text-lg font-semibold text-gray-800',
                                            'line-through text-gray-400' => $task->is_completed,
                                        ])>
                                            {{ $task->name }}
                                        </span>
                                        @if ($task->description)
                                            <p class="text-sm text-gray-500">
                                                {{ $task->description }}
                                            </p>
                                        @endif
                                    </div>

                                    @if ($task->due_date)
                                        <div class="ml-auto text-sm font-medium text-gray-500">
                                            Due {{ $task->getFormattedDueDate() }}
                                        </div>
                                    @endif
                                </form>
                            </li>
                        @empty
                            <div class="flex-col items-center text-center">
                                <img src="/empty project.png" alt="" class="w-22 h-22 block mx-auto">
                                <p class="text-lg font-bold">Welcome to your {{ $project->name }} view</p>
                                <p class="text-gray-400">{{ $project->description }}</p>
                                <x-primary-button href="{{ route('task.create') }}" class="mt-5 mb-20">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Add Task
                                </x-primary-button>
                            </div>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
