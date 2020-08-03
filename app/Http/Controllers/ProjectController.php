<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Validator as Validation;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Traits\AdminCheck;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProjectController extends Controller
{
    use AdminCheck;

    /**
     * Creating the edit container for a new project.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request) : JsonResponse
    {
        $user = auth('api')->user();
        $this->adminCheck($user);

        $categories = DB::table('categories')->get()->toArray();
        ob_start();
        echo view('admin.partials.admin-create', ['problem' => null, 'categories' => $categories]);
        $view = ob_get_clean();

        return response()->json(['result' => 'success', 'view' => $view]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        $user = auth('api')->user();
        $this->adminCheck($user);

        $args = $request->all();
        $project = new Project();
        $validator = $this->validator($args, $project->rules());

        if ($validator->fails()) {
            return response()->json(['result' => 'failed', 'errors' => $validator->errors()]);
        }

        $args['slug'] = Str::slug($args['title'] ?? null, '-');

        $project = Project::create($args);
        $project->updateCategories($project, $request);

        return $this->createEditContainer($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Project $project) : JsonResponse
    {
        $user = auth('api')->user();
        $this->adminCheck($user);

        $validator = $this->validator($request->all(), $project->rules());

        if ($validator->fails()) {
            return response()->json(['result' => 'failed', 'errors' => $validator->errors()]);
        }

        $args = $request->all();
        if (!empty($request->title)) {
            $args['slug'] = Str::slug($request->title ?? null, '-');
        }

        $project->updateCategories($project, $request);
        $project->update($args);

        return $this->createEditContainer($project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Project $project) : JsonResponse
    {
        $user = auth('api')->user();
        $this->adminCheck($user);

        return $this->createEditContainer($project);
    }

    /**
     * Display the deletion warning modal when removing project.
     *
     * @param \App\Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Project $project) : JsonResponse
    {
        $user = Auth::user();
        $this->adminCheck($user);

        ob_start();
        echo view('admin.modals.delete-project-modal', ['project' => $project]);
        $modal = ob_get_clean();

        return response()->json(['result' => 'success', 'modal' => $modal, 'project' => $project]);
    }

    /**
     * Remove the project from storage.
     *
     * @param \App\Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Project $project) : JsonResponse
    {
        $user = Auth::user();
        $this->adminCheck($user);

        $project->delete();
        $projects = DB::table('projects')->get();

        ob_start();
        echo view('admin.partials.admin-posts', ['projects' => $projects]);
        $view = ob_get_clean();

        return response()->json(['result' => 'success', 'view' => $view]);
    }

    /**
     * Create the full project edit container and return response.
     *
     * @param \App\Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function createEditContainer(Project $project) : JsonResponse
    {
        $mergedCategories = $project->mergedCategories();

        ob_start();
        echo view('admin.partials.admin-edit', ['project' => $project, 'categories' => $mergedCategories]);
        $view = ob_get_clean();

        return response()->json(['result' => 'success', 'view' => $view]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Project $project
     * @return \Illuminate\View\View
     */
    public function show(Project $project) : View
    {
        return view('project')->with([
            'project' => $project,
            'categories' => $project->categories()
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @param array $rules
     * @return Validator
     */
    protected function validator(array $data, array $rules) : Validation
    {
        return Validator::make($data, $rules);
    }
}
