<?php

namespace App\Logizar\Search;

use App\Models\Project;
use Illuminate\Support\Facades\DB;
use App\Logizar\Search\Stopwords\Stopwords;

class SearchEngine
{

    /**
     * On récupère les stops words
     * On calcul les mots clés
     * On calcul la partie de la requete de critère LIKE sur le nom du projet avec les mots clés
     * On vérifie si la requete possède un mot clé
     * Si oui on sélectionne les mots clés précédent
     * Si non on sélectionne les mots clés qui ne sont pas parmi les stopwords
     * On calcul la la partie de la requete de critere LIKE sur le propriété de description avec les mots sélectionnés
     * On concatène les deux requetes avec l'opérateur OR au centre
     * On trie en fonction du dégré de pertinence en langage naturel
     * On obtient les résultats
     * NOTE:
     * Lorsque la requete utilise un seul mot, on peut se permettre de négliger les stops words au niveau de la description. Mais si celle-ci est
     * composée de plusieurs mots on applique les stopswords sur la description du projet.
     * 
     * (!) Possibilité : Supprimer les doublons pour les mots de description
     * 
     */
    public function searchWithLikeAndOrderByFulltext($search_content)
    {

        $results = []; // Liste des résultats
        $query_name_parts = []; // Partie de la requete dédiée au nom
        $query_description_parts = []; // Partie de la requete dédiée à la description
        $query_mix_parts = []; // Concaténation des parties de la requete 
        $keys_clear = []; // Mots clés avec sans stopwords
        $keys_for_description = []; // Mots clés avec stopwords

        $stopwords = Stopwords::frWords();
        
        $keys = SearchEngine::getKeywords($search_content);

        foreach ($keys as $k) {
            $query_part = "(name LIKE \"%$k%\")";
            $query_name_parts[] = $query_part;
        }

        if(count($keys) == 1){
            $keys_for_description = $keys;
        }else{
            $keys_clear = array_diff($keys,$stopwords);
            $keys_for_description = $keys_clear;
        }

        foreach ($keys_for_description as $k) {
            $query_part = "(summary LIKE \"%$k%\" OR description LIKE \"%$k%\")";
            $query_description_parts[] = $query_part;
        }
       
        $query_mix_parts = implode(" OR ", $query_name_parts) . " OR " . implode(" OR ", $query_description_parts);

        $search_content = htmlspecialchars($search_content);

        $results = Project::whereRaw($query_mix_parts)
            ->select(DB::raw("*, MATCH (name,summary,description) AGAINST (\"$search_content\") as score"))
            ->orderByDesc("score")
            ->get();

        return $results;
    }

    public static function getKeywords($search_content){

        $search_content = htmlspecialchars($search_content);

        $keys = explode(" ", $search_content);

        $keys = array_filter($keys, function($k){
            return !ctype_space($k) and !empty($k);
        });
        
        return array_values($keys);
    }
}
