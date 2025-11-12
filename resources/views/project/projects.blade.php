<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="mb-4 text-2xl font-bold">My Projects</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class=" flex-col text-center items-center gap-2 mb-1">
                        <form method="GET" action="{{ route('project.projects') }}"
                            class=" w-[50%] mx-auto flex items-center bg-white rounded-xl shadow-lg overflow-hidden border-2 p-0.5 transition duration-300 w-50">
                            <x-search-icon-button />
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search Projects"
                                class="border-2 w-full py-3 px-4 text-lg text-gray-700 placeholder-gray-400 border-none focus:ring-0 transition duration-150"
                                aria-label="Search input field" />
                        </form>
                        <x-primary-button href="{{ route('project.create') }}" class="mt-5 mb-20">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Add Project
                        </x-primary-button>
                    </div>

                    <div>
                        <p class="text-lg font-medium">{{ $projects->count() }} Projects</p>
                        <hr class="mb-10 mt-1">
                        @foreach ($projects as $project)
                            {{-- TODO: implement project.show --}}
                            <a class="ml-10 mb-5 flex gap-4 items-center">
                                <x-hashtag-icon />
                                <h2>{{ $project->name }}<h2>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
