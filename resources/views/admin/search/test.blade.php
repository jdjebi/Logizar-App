@php

/**
 * Surligne les expressions de $string qui sont dans $keywords.
 */
function showKeywordsIn($string, $keywords)
{
    $words = explode(' ', $string);
    $expressions_list = [];
    foreach ($words as $word) {
        $skip_word = false;
        foreach ($keywords as $key) {
            $key = str_replace('e', '(é|e|è|ê)', $key);
            $key = '/' . $key . '/i';
            if (preg_match($key, $word)) {
                $expression = preg_replace($key, "<span class='bg-yellow-300'>$0</span>", $word);
                $expressions_list[] = $expression;
                $skip_word = true;
                break;
            }
        }
        if ($skip_word == false) {
            $expressions_list[] = $word;
        }
    }
    $new_string = implode(' ', $expressions_list);
    return $new_string;
}

@endphp

<x-layouts.tests>

    <h4>
        Recherche
    </h4>

    <form action="{{ route('admin.search.test') }}" method="GET">
        <input type="text" name="w">
    </form>
    <div>Résultat : {{ count($results) }} </div>

    <div class="my-4">
        <div class="font-bold">Recherche: {{ $search_content }}</div>
        <div>
            <div class="font-bold">Mots clés néttoyés:</div>
            <div>
                @foreach ($keywords_clear as $word)
                    <x-badges.badge>{{ $word }}</x-badges.badge>
                @endforeach
            </div>
        </div>
        <div>
            <div class="font-bold">Mots clés:</div>
            <div>
                @foreach ($keywords as $word)
                    <x-badges.badge-default class="text-indigo-800 bg-indigo-100">{{ $word }}</x-badges.badge>
                @endforeach
            </div>
        </div>
    </div>

    <div>
        @foreach ($results as $project)
            <div class="m-4 p-2 border">
                <div><span class="font-bold">Projet</span>: {!! showKeywordsIn($project->name, $keywords) !!}</div>
                <div>
                    <span class="font-bold">Score</span>: {{ $project->score }}
                </div>
                <div><span class="font-bold">Résumé</span>: {!! showKeywordsIn($project->summary, $keywords_clear) !!}</div>
                <div>
                    <span class="font-bold">Description</span>: : {!! showKeywordsIn($project->description, $keywords_clear) !!}
                </div>
            </div>
        @endforeach
    </div>

</x-layouts.tests>
