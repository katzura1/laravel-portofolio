<?php

namespace App\Http\Controllers\Admin;

use App\Helper\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectImageController extends Controller
{

    public function index(Request $request, $id)
    {
        $project = Project::find($id);
        // dd($project);
        if (!$project) {
            return back()->with('error', 'Project not found');
        }

        $projectImages = ProjectImage::where('id_project', $id)
            ->paginate(10);
        return view('admin.project-image', [
            'projectImages' => $projectImages,
            'project' => $project,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_project' => ['required', 'exists:projects,id'],
            'image' => ['required', 'image', 'max:4096'],
            'is_default' => ['required', 'boolean'],
        ]);

        if ($validator->fails()) {
            $errors = implode('<br/>', $validator->errors()->all());
            $keys = $validator->errors()->keys();
            return ResponseFormatter::error(500, $errors, $keys);
        }
        DB::beginTransaction();

        try {
            $validated = $validator->safe()->except('image');
            $validated['image'] = $this->saveImage($request->image, 'projects');

            if ($request->is_default == '1') {
                ProjectImage::where('id_project', $request->id_project)
                    ->update([
                        'is_default' => 0
                    ]);
            }

            $projectImage = new ProjectImage($validated);
            $projectImage->save();
            if ($projectImage) {
                DB::commit();
                return ResponseFormatter::success('Data berhasil disimpan.');
            }
            throw new \Exception("Data gagal disimpan", 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error(500, $e->getMessage());
        }
    }

    private function saveImage($image, $directory)
    {
        $nameFile = 'img_' . time() . '.' . $image->extension();
        $fileUpload = $image->storeAs('public/' . $directory, $nameFile); // upload image
        if (!Storage::exists($fileUpload)) {
            throw new \Exception(500, "File upload failed"); // check file upload
        }
        return 'storage/' . $directory . '/' . $nameFile;
    }

    private function updateImage($image, $directory, $oldImage)
    {
        $nameFile = 'img_' . time() . '.' . $image->extension();
        $fileUpload = $image->storeAs('public/' . $directory, $nameFile); // upload image
        if (!Storage::exists($fileUpload)) {
            throw new \Exception(500, "File upload failed"); // check file upload
        }
        //delete old image
        if (!$this->deleteImage($oldImage)) {
            throw new \Exception(500, "File upload failed"); // check file upload
        }
        return 'storage/' . $directory . '/' . $nameFile;
    }

    private function deleteImage($image)
    {
        try {
            if (!empty($oldImage)) {
                // Check if the folder exists
                if (!is_dir(Storage::path($oldImage))) {
                    // The path is not a directory
                    Storage::delete('public/' . str_replace('storage', '', $oldImage));
                }
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'exists:project_images,id'],
            'image' => ['sometimes', 'required', 'image', 'max:4096'],
            'is_default' => ['required', 'in:1,0'],
        ]);

        if ($validator->fails()) {
            $errors = implode('<br/>', $validator->errors()->all());
            $keys = $validator->errors()->keys();
            return ResponseFormatter::error(500, $errors, $keys);
        }
        DB::beginTransaction();

        try {
            $validated = $validator->safe()->except(['id', 'image']);

            if ($request->is_default == '1') {
                ProjectImage::where('id_project', $request->id_project)
                    ->update([
                        'is_default' => 0
                    ]);
            }

            $projectImage = ProjectImage::find($request->id);
            $projectImage->update($validated);
            if ($projectImage) {
                //if image exists in request update the project image
                if ($request->image) {
                    $projectImage->image = $this->updateImage(
                        $request->image,
                        'projects',
                        $projectImage->image
                    );
                    $projectImage->save();
                }
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
            'id' => ['required', 'exists:project_images,id'],
        ]);

        if ($validator->fails()) {
            $errors = implode('<br/>', $validator->errors()->all());
            $keys = $validator->errors()->keys();
            return ResponseFormatter::error(500, $errors, $keys);
        }
        DB::beginTransaction();

        try {
            $projectImage = ProjectImage::find($request->id);
            if ($projectImage) {
                //change is_default

                $otherImage = ProjectImage::where('id_project', $projectImage->id_project)
                    ->where('id', '!=', $projectImage->id)
                    ->first();
                if ($otherImage) {
                    $otherImage->update('is_default', 1);
                }

                //delete project image
                $this->deleteImage($projectImage->image);
                //delete stack
                ProjectImage::where('id', $projectImage->id)->delete();

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
