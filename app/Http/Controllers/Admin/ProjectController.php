<?php

namespace App\Http\Controllers\Admin;

use App\Helper\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectStack;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        // dd(session()->all());
        $projects = Project::orderBy('start_periode')->paginate(10);

        return view('admin.project', [
            'projects' => $projects
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'start_periode' => ['required', 'date'],
            'end_periode' => ['required', 'date', 'after_or_equal:start_periode'],
            'summary' => ['required', 'string'],
            'link' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            $errors = implode('<br/>', $validator->errors()->all());
            $keys = $validator->errors()->keys();
            return ResponseFormatter::error(500, $errors, $keys);
        }
        DB::beginTransaction();

        try {
            $validated = $validator->validated();
            $project = new Project($validated);
            $project->save();
            if ($project) {
                DB::commit();
                return ResponseFormatter::success('Data berhasil disimpan.');
            }
            throw new Exception("Data gagal disimpan", 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error(500, $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'exists:projects,id'],
            'title' => ['required'],
            'start_periode' => ['required', 'date'],
            'end_periode' => ['required', 'after_or_equal:start_periode'],
            'summary' => ['required', 'string'],
            'link' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            $errors = implode('<br/>', $validator->errors()->all());
            $keys = $validator->errors()->keys();
            return ResponseFormatter::error(500, $errors, $keys);
        }
        DB::beginTransaction();

        try {
            $validated = $validator->safe()->except('id');
            $project = Project::find($request->id);
            $project->update($validated);
            if ($project) {
                DB::commit();
                return ResponseFormatter::success('Data berhasil diupdate.');
            }
            throw new Exception("Data gagal diupdate", 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error(500, $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'exists:projects,id'],
        ]);

        if ($validator->fails()) {
            $errors = implode('<br/>', $validator->errors()->all());
            $keys = $validator->errors()->keys();
            return ResponseFormatter::error(500, $errors, $keys);
        }
        DB::beginTransaction();

        try {
            $project = Project::find($request->id);
            if ($project) {
                //delete stack
                ProjectStack::where('id_project', $project->id)->delete();
                //delete image
                $images = ProjectImage::where('id_project', $project->id)->get();
                foreach ($images as $key => $image) {
                    Storage::delete('public/images/' . $image->image);
                    ProjectImage::find($image->id)->delete();
                }
                $project->delete();
                DB::commit();
                return ResponseFormatter::success('Data berhasil dihapus.');
            }
            throw new Exception("Data gagal dihapus", 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error(500, $e->getMessage());
        }
    }
}
