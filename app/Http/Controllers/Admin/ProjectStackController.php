<?php

namespace App\Http\Controllers\Admin;

use App\Helper\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectStack;
use App\Models\Stack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjectStackController extends Controller
{

    public function index(Request $request, $id)
    {
        $project = Project::find($id);
        // dd($project);
        if (!$project) {
            return back()->with('error', 'Project not found');
        }

        $stacks = Stack::all(['id', 'name']);
        $projectStacks = ProjectStack::with(['stack'])
            ->where('id_projegact', $id)
            ->paginate(10);
        return view('admin.project-stack', [
            'stacks' => $stacks,
            'projectStacks' => $projectStacks,
            'project' => $project,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_project' => ['required', 'exists:projects,id'],
            'id_stack' => ['required', 'exists:stacks,id'],
        ]);

        if ($validator->fails()) {
            $errors = implode('<br/>', $validator->errors()->all());
            $keys = $validator->errors()->keys();
            return ResponseFormatter::error(500, $errors, $keys);
        }
        DB::beginTransaction();

        try {
            $validated = $validator->validated();
            $checkDuplicate = ProjectStack::where($validated)->first();
            if ($checkDuplicate) {
                throw new \Exception("Project stack already exists.", 500);
            }
            $projectStack = new ProjectStack($validated);
            $projectStack->save();
            if ($projectStack) {
                DB::commit();
                return ResponseFormatter::success('Data berhasil disimpan.');
            }
            throw new \Exception("Data gagal disimpan", 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error(500, $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'exists:project_stacks,id'],
            'id_project' => ['required', 'exists:projects,id'],
            'id_stack' => ['required', 'exists:stacks,id'],
        ]);

        if ($validator->fails()) {
            $errors = implode('<br/>', $validator->errors()->all());
            $keys = $validator->errors()->keys();
            return ResponseFormatter::error(500, $errors, $keys);
        }
        DB::beginTransaction();

        try {
            $validated = $validator->safe()->except('id');
            $projectStack = ProjectStack::find($request->id);
            $projectStack->update($validated);
            if ($projectStack) {
                DB::commit();
                return ResponseFormatter::success('Data berhasil diupdate.');
            }
            throw new \Exception("Data gagal diupdate", 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error(500, $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'exists:project_stacks,id'],
        ]);

        if ($validator->fails()) {
            $errors = implode('<br/>', $validator->errors()->all());
            $keys = $validator->errors()->keys();
            return ResponseFormatter::error(500, $errors, $keys);
        }
        DB::beginTransaction();

        try {
            $projectStack = ProjectStack::find($request->id);
            if ($projectStack) {
                //delete stack
                ProjectStack::where('id', $projectStack->id)->delete();

                DB::commit();
                return ResponseFormatter::success('Data berhasil dihapus.');
            }
            throw new \Exception("Data gagal dihapus", 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error(500, $e->getMessage());
        }
    }
}
