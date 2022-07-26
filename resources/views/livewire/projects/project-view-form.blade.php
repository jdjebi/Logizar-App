<div>
    <div class="bg-zinc-50">
        <div class="py-10 px-5 sm:px-10 md:px-28">
            <div>
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-3xl font-semibold">{{ $project->name }}</div>
                        @isset($project->code_name)
                            @php
                                $projectUrl = route('project.show.bycodename', $project->code_name);
                            @endphp
                            <div>
                                <a class="text-blue-600 text-xs font-bold hover:underline" href="{{ $projectUrl }}">
                                    <span class="">{{ $projectUrl }}</span>
                                </a>
                            </div>
                        @endisset
                    </div>
                    @auth
                        @if (Auth::user()->id == $project->user->id)
                            <div>
                                <x-buttons.default :href="route('project.update', $project->id)">Modifier</x-buttons.default>
                            </div>
                        @endif
                    @endauth
                </div>
                <div>
                    <div class="mt-3 mb-5">
                        <x-project.category.category-liner :categories="$project->categories()">
                            </x-project>
                    </div>
                    <div>
                        <span class="text-gray-600">{{ $project->summary }}</span>
                    </div>
                </div>
            </div>
            <div class="mt-4 flex justify-between items-center">
                <div>
                    <span class="text-sm text-blue-500">Par {{ $project->user->name }}</span>
                </div>
                <div>
                    <x-badges.badge-default class="bg-cyan-100 text-cyan-800">
                        @if ($project->is_opensource)
                            opensource
                        @else
                            non-opensource
                        @endif
                    </x-badges.badge-default>

                    @empty(!$project->status)
                        @switch("in_progress")
                            @case('in_progress')
                                <x-badges.badge-default class="bg-blue-200 text-blue-800">
                                    {{ $project->statusFull()['label'] }}
                                </x-badges.badge-default>
                            @break

                            @case('pause')
                                <x-badges.badge-default class="bg-gray-100 text-gray-800">
                                    {{ $project->statusFull()['label'] }}
                                </x-badges.badge-default>
                            @break

                            @case('ended')
                                <x-badges.badge-default class="bg-green-100 text-green-800">
                                    {{ $project->statusFull()['label'] }}
                                </x-badges.badge-default>
                            @break

                            @case('abort')
                                <x-badges.badge-default class="bg-red-100 text-red-800">
                                    {{ $project->statusFull()['label'] }}
                                </x-badges.badge-default>
                            @break

                            <x-badges.badge>
                                {{ $project->statusFull()['label'] }}
                            </x-badges.badge>

                            @default
                        @endswitch
                    @else
                        <x-badges.badge>
                            Aucun statut
                        </x-badges.badge>
                    @endempty
                </div>
            </div>
        </div>
    </div>

    <div class="py-5 px-5 sm:px-10 md:px-28">
        <div class="grid grid-cols-1 md:grid-cols-6 md:gap-10">

            <div class="md:col-span-4">
                <div>
                    <div class="text-2xl font-normal">Présentation</div>
                </div>
                <div class="mt-3">
                    <span class="text-slate-700 text-sm">Posté le {{ $project->created_at->format('d/m/Y') }}</span>
                </div>
                <div class="mt-6">
                    <div class="text-slate-700 text-md whitespace-pre-line break-words">{!! $project->makeLinkClickable($project->description, 'text-blue-600 font-semibold hover:underline') !!}</div>
                </div>
                <div class="mt-5">
                    @foreach ($project->tags as $tag)
                        <div class="inline-block px-5 py-1.5 border rounded-full mr-3 hover:bg-gray-100 cursor-pointer">
                            {{ $tag->name }}
                        </div>
                    @endforeach
                </div>
                @auth
                    @if (Auth::user()->id == $project->user->id)
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

            <div class="hidden md:block md:col-span-2">
                <div>
                    <div class="mb-4">
                        <span class="text-2xl">Infos</span>
                    </div>
                    <div class="mb-5 break-words break-all">

                        @foreach ($project->tags as $tag)
                            <x-badges.badge class="inline-block mb-2">
                                {{ $tag->name }}
                            </x-badges.badge>
                        @endforeach
                    </div>
                    <div class="flex text-md">
                        <div class="text-gray-700">
                            <i class="fa-solid fa-globe"></i>
                        </div>
                        <div class="ml-5">
                            <div><span class="font-bold">Site web</span></div>
                            <div>
                                <span class="text-gray-500">
                                    <a href="{{ $project->site_url }}">{{ $project->site_url }}</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex text-md mt-5">
                        <div class="text-gray-700">
                            <i class="fa-brands fa-github"></i>
                        </div>
                        <div class="ml-5">
                            <div><span class="font-bold">Dépôt</span></div>
                            <div>
                                <span class="text-gray-500">
                                    <a href="{{ $project->repository_url }}">{{ $project->repository_url }}</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex text-md mt-5">
                        <div class="text-gray-700">
                            <i class="fa-solid fa-hammer"></i>
                        </div>
                        <div class="ml-5">
                            <div><span class="font-bold">Type de projet</span></div>
                            <div><span
                                    class="text-gray-500">{{ $project->type ? $project->type->name : 'Aucun' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex text-md mt-5">
                        <div class="text-gray-700">
                            <i class="fa-solid fa-gift"></i>
                        </div>
                        <div class="ml-5">
                            <div><span class="font-bold">Livrable</span></div>
                            <div><span
                                    class="text-gray-500">{{ $project->deliverable ? $project->deliverable->name : 'Aucun' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
