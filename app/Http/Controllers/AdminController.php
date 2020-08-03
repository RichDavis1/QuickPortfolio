<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Validator as Validation;
use Illuminate\Support\Facades\DB;
use App\Project;
use App\AdminSettings;
use App\Contact;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use App\Traits\AdminCheck;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
    use AdminCheck, AuthenticatesUsers;

    /**
     * Creating the edit container for a new project.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createContainer() : JsonResponse
    {
        $user = Auth::user();
        $this->adminCheck($user);

        $mergedCategories = (new Project())->mergedCategories();

        ob_start();
        echo view('admin.partials.admin-create', ['project' => null, 'categories' => $mergedCategories]);
        $view = ob_get_clean();

        return response()->json(['result' => 'success', 'view' => $view]);
    }

    /**
     * Creating the edit container for a new project.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editContainer(Request $request) : JsonResponse
    {
        $user = Auth::user();
        $this->adminCheck($user);

        if (!is_numeric($request->postId)) {
            header('HTTP/1.0 403 Forbidden', true, 403);
            exit();
        }

        $project = Project::where('id', $request->postId)->firstOrFail();
        $mergedCategories = $project->mergedCategories();

        ob_start();
        echo view('admin.partials.admin-edit', ['project' => $project, 'categories' => $mergedCategories]);
        $view = ob_get_clean();

        return response()->json(['result' => 'success', 'view' => $view]);
    }

    /**
     * Creating the edit container for a new project.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPostsContainer() : JsonResponse
    {
        $user = Auth::user();
        $this->adminCheck($user);

        $projects = DB::table('projects')->get();

        ob_start();
        echo view('admin.partials.admin-posts', ['projects' => $projects]);
        $view = ob_get_clean();

        return response()->json(['result' => 'success', 'view' => $view]);
    }

    /**
     * Create & return the edit container for a new project.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function settingsContainer() : JsonResponse
    {
        $user = Auth::user();
        $this->adminCheck($user);

        $categories = DB::table('categories')->get();

        ob_start();
        echo view('admin.partials.admin-settings', ['settings' => new AdminSettings(), 'categories' => $categories]);
        $view = ob_get_clean();

        return response()->json(['result' => 'success', 'view' => $view]);
    }

    /**
     * Create & return the contact container.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function contactContainer() : JsonResponse
    {
        $user = Auth::user();
        $this->adminCheck($user);

        $contacts = Contact::get();

        ob_start();
        echo view('admin.partials.admin-contacts', ['contacts' => $contacts]);
        $view = ob_get_clean();

        return response()->json(['result' => 'success', 'view' => $view]);
    }

    /**
     * Return view for admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function show() : View
    {
        if (!Schema::hasTable('migrations')) {
            Artisan::call('migrate');

            return view('admin.admin-registration');
        }

        if (!User::adminExists()) {
            return view('admin.admin-registration');
        }

        if (!Auth::user() || !Auth::user()->isAdmin()) {
            return view('admin.admin-login');
        }

        $posts = DB::table('projects')->get();

        return view('admin.admin', ['projects' => $posts]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) : Validation
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
