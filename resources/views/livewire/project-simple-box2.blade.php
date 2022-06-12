<div class="p-4 mb-3 border box-border border-slate-400 rounded hover:border-blue-500 hover:shadow focus:ring-blue-300 active:ring-blue-300 transition">
    <a href="{{ route('project.show.public',$project_id) }}">
        <div class="text-xl font-semibold ">{{ $name }}</div>
        <div class="text-slate-500 text-sm">{{ $owner->name }} &middot; {{ $created_at }}</div>
        <div class="mt-2">
            {{ $description }}
        </div>
        <div class="mt-3">
            <x-buttons.light :href="route('project.show.public',$project_id)" class="text-xs">Afficher</x-buttons.light>
        </div>
    </a>
</div>