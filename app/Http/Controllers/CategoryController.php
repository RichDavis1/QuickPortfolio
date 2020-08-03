<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryAssignment;
use App\AdminSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Validator as Validation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Traits\AdminCheck;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    use AdminCheck;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create() : JsonResponse
    {
        $user = Auth::user();
        $this->adminCheck($user);

        ob_start();
        echo view('admin.modals.add-category-modal');
        $modal = ob_get_clean();

        return response()->json(['result' => 'success', 'modal' => $modal]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        $user = Auth::user();
        $this->adminCheck($user);

        $args = $request->all();
        $validator = $this->validator($args);

        if ($validator->fails()) {
            return response()->json(['result' => 'failed', 'errors' => $validator->errors()]);
        }

        if (!empty($request->label)) {
            $args['slug'] = Str::slug($request->label ?? null, '-');
        }

        Category::create($args);

        return response()->json(['result' => 'success', 'view' => $this->createContainer()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category) : JsonResponse
    {
        $categoryAssignment = new CategoryAssignment();
        $categoryAssignment->removeCategory($category);
        $category->delete();

        return response()->json(['result' => 'success', 'view' => $this->createContainer()]);
    }

    /**
     * Create the admin categories settings container.
     *
     * @return string
     */
    protected function createContainer() : string
    {
        $categories = DB::table('categories')->get();

        ob_start();
        echo view('admin.partials.admin-settings', ['settings' => new AdminSettings(), 'categories' => $categories]);
        $view = ob_get_clean();

        return (string) $view;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @param array|null $rules
     * @return Validator
     */
    protected function validator(array $data, ?array $rules = null) : Validation
    {
        $rules = is_array($rules) ? $rules : Category::$rules;

        return Validator::make($data, $rules);
    }
}
