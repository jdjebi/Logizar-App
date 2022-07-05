<?php

namespace App\Logizar\Search;

use App\Models\Project;
use Illuminate\Support\Facades\DB;

class SearchEngine
{

    /**
     * On extrait les mots clés de la requete de recherche
     * On evalue le critere LIKE sur chaque clée
     * On trie en fonction du dégré de pertinence en langage naturel
     */
    public function searchWithLikeAndOrderByFulltext($searchContent)
    {

        $results = [];
        $query_parts = [];
        $query_mix_parts = [];
        $keys = explode(" ", $searchContent);

        foreach ($keys as $k) {
            $query_part = "(name LIKE '%$k%' OR summary LIKE '%$k%' OR description LIKE '%$k%')";
            $query_parts[] = $query_part;
        }

        $query_mix_parts = implode(" OR ", $query_parts);

        $results = Project::whereRaw($query_mix_parts)
            ->select(DB::raw("*, MATCH (name,summary,description) AGAINST ('$searchContent') as score"))
            ->orderByDesc("score")
            ->get();

        return $results;
    }
}
