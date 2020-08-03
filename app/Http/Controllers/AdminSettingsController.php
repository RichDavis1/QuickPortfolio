<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Validator as Validation;
use Illuminate\Support\Facades\DB;
use App\AdminSettings;
use Illuminate\Support\Facades\Auth;
use App\Traits\AdminCheck;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use App\Traits\Sanitization;

class AdminSettingsController extends Controller
{
    use AdminCheck, AuthenticatesUsers, Sanitization;

    /**
     * Update specific field and value in request.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request) : JsonResponse
    {
        $user = auth('api')->user();
        $this->adminCheck($user);

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return response()->json(['result' => 'failed', 'errors' => $validator->errors()]);
        }

        AdminSettings::updateOrCreate(
            ['field' => $request->field],
            ['field' => $request->field, 'value' => $request->value]
        );

        $view = $this->settingsContainer();

        return response()->json(['result' => 'success', 'field' => $this->cleanPost($request->field), 'value' => $this->cleanPost($request->value), 'view' => $view]);
    }

    /**
     * Creating the edit container for a new project.
     *
     * @return string
     */
    public function settingsContainer() : string
    {
        $user = Auth::user();
        $this->adminCheck($user);

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
     * @return Validator
     */
    protected function validator(array $data) : Validation
    {
        return Validator::make($data, AdminSettings::$rules);
    }
}
