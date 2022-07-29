@php

switch ($project->status) {
    case 'in_progress':
        $bgClass = 'bg-blue-400';
        break;

    case 'pause':
        $bgClass = 'bg-slate-400';
        break;

    case 'abort':
        $bgClass = 'bg-red-400';
        break;

    case 'ended':
        $bgClass = 'bg-green-400';
        break;

    default:
        $bgClass = 'bg-neutral-500';
}

$title = $project->status ? $project->status_full : 'Aucun statut';
@endphp

<div class="w-3 h-3 {{ $bgClass }} border-2 border-white rounded-full" title="{{ $title }}"></div>
