<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('start_periode', 'DESC')->paginate(3);

        $projects->getCollection()->transform(function ($item) {
            $projectImage = ProjectImage::where('id_project', $item->id)
                ->where('is_default', 1)->first();
            $item->image = $projectImage ? url($projectImage->image) : "#";
            return $item;
        });

        return view('welcome', [
            'projects' => $projects
        ]);
    }

    public function projects(Request $request)
    {
        $projects = Project::orderBy('start_periode', 'DESC')->paginate(6);

        $projects->getCollection()->transform(function ($item) {
            $projectImage = ProjectImage::where('id_project', $item->id)
                ->where('is_default', 1)->first();
            $item->image = $projectImage ? url($projectImage->image) : "#";
            return $item;
        });

        return view('project-list', [
            'projects' => $projects
        ]);
    }

    public function projectDetail($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return abort(404);
        }
        $project->load('stack.stack');
        $project->load('image');
        $project = $project->toArray();

        foreach ($project['image'] as $key => $value) {
            $project['image'][$key]['image'] = url($value['image']);
        }

        $projects = Project::orderBy('start_periode', 'DESC')->paginate(5);

        $projects->getCollection()->transform(function ($item) {
            $projectImage = ProjectImage::where('id_project', $item->id)
                ->where('is_default', 1)->first();
            $item->image = $projectImage ? url($projectImage->image) : "#";
            return $item;
        });

        return view('project-detail', [
            'project' => $project,
            'projects' => $projects,
        ]);
    }

    public function projectSitemap(Request $request)
    {
        $projects = Project::orderBy('created_at', 'DESC')->get();
        return response()->view('project-sitemap', ['projects' => $projects])
            ->header('Content-Type', 'text/xml');
    }
}
