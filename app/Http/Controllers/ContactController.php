<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Validator as Validation;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create() : JsonResponse
    {
        ob_start();
        echo view('core.modals.contact-modal');
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
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return response()->json(['result' => 'failed', 'errors' => $validator->errors()]);
        }

        $contact = Contact::create($request->all());

        return response()->json(['result' => 'success', 'contact' => $contact]);
    }

    /**
     * Get a validator for an incoming contact request.
     *
     * @param array $data
     * @return Validator
     */
    protected function validator(array $data) : Validation
    {
        return Validator::make($data, Contact::$rules);
    }
}
