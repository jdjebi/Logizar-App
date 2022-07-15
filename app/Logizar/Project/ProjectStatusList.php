<?php

namespace App\Logizar\Project;

class ProjectStatusList
{
    const STATUS_LIST = [
        "in_progress" => ["name" => "in_progress", "label" => "En cours", ],
        "in_pause" => ["name" => "in_pause", "label" => "En pause"],
        "idea" => ["name" => "idea", "label" => "Idée"],
        "abort" => ["name" => "abort", "label" => "Abondonné"],
        "ended" => ["name" => "ended", "label" => "Terminé"],
    ];

}
