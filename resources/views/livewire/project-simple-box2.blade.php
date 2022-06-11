<div class="p-4 mb-3 border box-border border-slate-400 rounded">
    <div class="text-xl font-semibold ">{{ $name }}</div>
    <div class="text-slate-500 text-sm">{{ $owner->name }} &middot; {{ $created_at }}</div>
    <div class="mt-2">
        {{ $description }}
    </div>
</div>