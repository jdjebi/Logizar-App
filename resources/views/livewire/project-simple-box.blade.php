<div class="p-4">
    <div class="text-xl font-semibold ">{{ $name }}</div>
    <div class="text-slate-500 text-sm">{{ $owner->name }} &middot; {{ $created_at }}</div>
    <div class="mt-2">
        {{ $description }}
    </div>
    <div class="mt-4">
        <x-buttons.light :href="route('project.show',$project_id)" class="text-xs">Afficher</x-buttons.light>

        <x-buttons.default :href="route('project.update',$project_id)" class="text-xs">Modifier</x-buttons.default>

        <x-buttons.red href="#delete" class="text-xs">Supprimer</x-buttons.red>
    </div>
</div>
<hr>