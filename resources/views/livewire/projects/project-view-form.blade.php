<div>
    <div class="bg-zinc-50">
        <div class="py-10 px-5 sm:px-10 md:px-52 ">
            <div class="flex justify-between items-center">
                <div class="text-3xl font-semibold">{{ $project->name }}</div>    
                @auth
                    @if(Auth::user()->id == $project->user->id) 
                        <div>
                            <x-buttons.default href="#edit">Modifier</x-buttons.default>
                        </div>  
                    @endif 
                @endauth        
            </div>
            
            <div class="mt-2">
                <span class="text-sm text-blue-500">Par {{ $project->user->name }}</span>
            </div>
        </div>
    </div>
    <div class="py-5 px-5 sm:px-10 md:px-52">
        <div>
            <div class="text-2xl font-normal">Présentation</div>
        </div>
        <div class="mt-3">
            <span class="text-slate-700 text-sm">Posté le {{ $project->created_at->format('d/m/Y'); }}</span>
        </div>
        <div class="mt-6">
            <div class="text-slate-700">
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
                        <x-buttons.red href="#delete">Supprimer</x-buttons.red>
                    </div>
                </div>
            @endif
        @endauth
    </div>
</div>