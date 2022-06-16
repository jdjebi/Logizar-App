<div>
    <div class="bg-zinc-50">
        <div class="py-10 px-5 sm:px-10 md:px-64">
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-3xl font-semibold">{{ $project->name }}</div>    
                    <div>
                        <span class="text-gray-600">{{ $project->summary }}</span>
                    </div>
                </div>
                @auth
                    @if(Auth::user()->id == $project->user->id) 
                        <div>
                            <x-buttons.default :href="route('project.update',$project->id)">Modifier</x-buttons.default>
                        </div>  
                    @endif 
                @endauth        
            </div>
            
            <div class="mt-2">
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
            <div class="text-slate-700 text-md leading-loose ">
                {{ $project->description }}
            </div>
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