<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Logizar\Search\SearchEngine;

class SearchController extends Controller
{
    public function basic(Request $request){

        $searchContent = $request->w;

        if(!empty($searchContent)){
            $searchEngine = new SearchEngine();  
            $results = $searchEngine->searchWithLikeAndOrderByFulltext($searchContent);
        }else{
            $results = [];
        }

        $nbrResults = count($results);
    
        return view("search.basic",[
            "nbrResults" => $nbrResults,
            "results" => $results,
            "searchContent" => $searchContent
        ]);

    }
}
