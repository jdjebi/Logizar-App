<?php

namespace App\Logizar\Search\Stopwords;

class Stopwords{

    static public function frWords(){
        $file = __DIR__ . '/fr.php';
        $words = require $file;
        return $words;
    }

}