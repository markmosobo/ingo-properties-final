<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return response()->json([
            "lists" => [
            'status' => true,
            'projects' => $projects
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!empty($request->image)){
            $photo_name = time().'.' . explode('/', explode(':', substr($request->image,0,strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(storage_path('app/public/projects/').$photo_name);

        }else{
            $photo_name = '';
        }
        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'image_path' => $photo_name,
        ]);

        return response()->json([
            'status' => true,
            'message' => "Project Created successfully!",
            'project' => $project
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        if(!empty($request->image)){
            $photo_name = time().'.' . explode('/', explode(':', substr($request->image,0,strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(storage_path('app/public/projects/').$photo_name);

        }else{
            $photo_name = '';
        }
        $project->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Project Updated successfully!",
            'project' => $project
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        if($project){
        $project->delete();

        return response()->json([
            'status' => true,
            'message' => "Project Deleted successfully!",
        ], 200);
        }
    }

    public function single(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => "success",
            'project' => $project
        ], 200);
    }

    public function complete(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        if($project){
            $project->update(array('status' => 1));
            $project->save();
        }
    }

    public function feature(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        if($project){
            $project->update(array('featured' => 1));
            $project->save();
        }
    }

    public function unfeature(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        if($project){
            $project->update(array('featured' => 0));
            $project->save();
        }
    }

    public function close(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        if($project){
            $project->update(array('status' => 2));
            $project->save();
        }
    }

    public function reopen(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        if($project){
            $project->update(array('status' => 1));
            $project->save();
        }
    }

}
