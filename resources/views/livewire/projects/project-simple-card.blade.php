<div class="break-inside-avoid p-4 mb-3 border box-border border-slate-400 rounded hover:border-blue-500 hover:shadow focus:ring-blue-300 active:ring-blue-300 transition">
    <a href="{{ route('project.show.public',$project->id) }}">
        <div class="text-xl font-semibold ">{{ $project->name }}</div>
        <div class="text-slate-500 text-sm">{{ $project->user->name }} &middot; {{ $project->created_at->format('d/m/Y'); }}</div>
        <div class="mt-2">
            {{ $project->summary ? Str::words($project->summary , 30) : Str::words($project->description , 30) }}
        </div>
        <div class="mt-3">
            <x-buttons.light :href="route('project.show.public',$project->id)" class="text-xs">Afficher</x-buttons.light>
        </div>
    </a>
</div>