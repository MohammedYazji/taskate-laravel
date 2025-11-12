<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold text-gray-800 mb-8">
                Create New Project
            </h1>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl p-10">
                <form action="{{ route('project.store') }}" method="post" enctype="multipart/form-data">

                    @csrf

                    {{-- Name --}}
                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Project Name')" />
                        <input
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-600 focus:ring-indigo-600 rounded-lg shadow-sm"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                        >
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
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

                    {{-- Deadline --}}
                    <div class="mb-6">
                        <x-input-label for="deadline" :value="__('Deadline')" />
                        <x-text-input
                            id="deadline"
                            class="block mt-1 w-full"
                            type="datetime-local"
                            name="deadline"
                            :value="old('deadline')"
                            autofocus
                        />
                        <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex justify-end pt-4 border-t border-gray-100">
                        <x-primary-button>
                            Create Project
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
