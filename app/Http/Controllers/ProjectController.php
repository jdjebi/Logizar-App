<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
use Illuminate\Support\ItemNotFoundException;

class ProjectController extends Controller
{

    public function create()
    {
        return view("project.create");
    }

    /**
     * Affiche un projet en fonction de son nom de code.
     * $code_name est obligatoire dans la pratique, mais sa valeur vide par défaut s'explique
     * par le fait de l'usage de route('project.show.bycodename') dans les formulaires de création et modification
     * qui neccessite pas l'usage du $code_name. Ainsi, $code_name est considéré comme optionel dans sa route avec
     * {code_name?} et dans la signature de son controlleur avec une valeur vide par défaut mais reste obligatoire
     * pour fournir une réponse. Si code_name est vide alors une erreur 404 est retournée.
     */
    public function showByCodeName(Request $request, $code_name = "")
    {
        if (empty($code_name))
            abort(404);

        try{
            $project = Project::where("code_name", $code_name)->get()->firstOrFail();
        }catch(ItemNotFoundException $e){
            abort(404);   
        }

        return view("project.project-show", [
            "project" => $project
        ]);
    }

    public function showById(Request $request, $id)
    {

        $project = Project::findOrFail($id);

        return view("project.project-show", [
            "project" => $project
        ]);
    }

    public function update(Request $request, $id)
    {

        $project = Project::findOrFail($id);

        return view("project.update", [
            "project" => $project
        ]);
    }
}
