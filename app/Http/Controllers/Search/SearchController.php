<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Logizar\Search\SearchEngine;
use App\Logizar\Search\Stopwords\Stopwords;


class SearchController extends Controller
{
    
    public function basic(Request $request)
    {
        $search_content = $request->w;

        if (!empty($search_content)) {
            $searchEngine = new SearchEngine();
            $results = $searchEngine->searchWithLikeAndOrderByFulltext($search_content);
        } else {
            $results = [];
        }

        $nbr_results = count($results);

        return view("search.basic", [
            "nbr_results" => $nbr_results,
            "results" => $results,
            "search_content" => $search_content
        ]);
    }

    public function test(Request $request)
    {
        $keywords = [];
        $keywords_clear = [];

        $search_content = $request->w;

        if (!empty($search_content)) {
            $searchEngine = new SearchEngine();
            $results = $searchEngine->searchWithLikeAndOrderByFulltext($search_content);
        } else {
            $results = [];
        }

        $keywords = SearchEngine::getKeywords($search_content);

        if(count($keywords) == 1){
            $keywords_clear = $keywords;
        }else{
            $keywords_clear = array_values(array_diff($keywords,Stopwords::frWords()));
        }

        return view("admin.search.test", [
            "results" => $results,
            "search_content" => $search_content,
            "keywords" => $keywords,
            "keywords_clear" => $keywords_clear
        ]);
    }

}
