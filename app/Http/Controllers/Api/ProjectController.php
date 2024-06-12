<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index() {
        // $projects = Project::all();
        $projects = Project::with('technologies', 'type')->paginate(6);

        return response()->json([
            'success' => true,
            'results' => $projects
        ]);
    }

    public function show($slug) {
        $project = Project::where('slug', '=', $slug)->with('technologies', 'type')->first();

        $apiData = [];
        if($project) {
            $apiData = [
                'success' => true,
                'project' => $project
            ];
        } else {
            $apiData = [
                'success' => false,
                'error' => 'no project found with this slug'
            ];
        }

        return response()->json($apiData);

    }
}
