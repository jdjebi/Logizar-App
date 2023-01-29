<?php

namespace App\Logizar\Project;

class ProjectStatusList
{
    const STATUS_LIST = [
        "none" => ["name" => "none", "label" => "Aucun", ],
        "in_progress" => ["name" => "in_progress", "label" => "En cours", ],
        "pause" => ["name" => "pause", "label" => "En pause"],
        "abort" => ["name" => "abort", "label" => "Abondonné"],
        "ended" => ["name" => "ended", "label" => "Terminé"],
    ];

}
