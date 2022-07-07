<div>
    <div class="bg-zinc-50">
        <div class="py-10 px-5 sm:px-10 md:px-64">
            <div>
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-3xl font-semibold">{{ $project->name }}</div>    
                    </div>
                    @auth
                        @if(Auth::user()->id == $project->user->id) 
                            <div>
                                <x-buttons.default :href="route('project.update',$project->id)">Modifier</x-buttons.default>
                            </div>  
                        @endif 
                    @endauth        
                </div>
                <div>
                    <div class="mt-2 mb-3">
                        <x-project.category.category-liner :categories="$project->categories()"></x-project>
                    </div>
                    <div>
                        <span class="text-gray-600">{{ $project->summary }}</span>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-blue-500">Par {{ $project->user->name }}</span>
            </div>
        </div>
    </div>
    <div class="py-5 px-5 sm:px-10 md:px-64">
        <div>
            <div class="text-2xl font-normal">Présentation</div>
        </div>
        <div class="mt-3">
            <span class="text-slate-700 text-sm">Posté le {{ $project->created_at->format('d/m/Y'); }}</span>
        </div>
        <div class="mt-6">
            <div class="text-slate-700 text-lg leading-loose whitespace-pre-line">{!! $project->makeLinkClickable($project->description,"text-blue-600 font-semibold hover:underline") !!}</div>
        </div>
        @auth
            @if(Auth::user()->id == $project->user->id)
                <div>
                    <div class="my-10">
                        <hr>
                    </div>
                    <div>
                        @livewire('projects.delete.project-delete-button', ['project' => $project])
                    </div>
                </div>
            @endif
        @endauth
    </div>
</div>