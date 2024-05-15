<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\PatientStoreRequest;
use Illuminate\Routing\Controller as BaseController;

class PatientController extends BaseController
{

    public function __construct()
    {
    }

    public function store(PatientStoreRequest $request)
    {
        try {
            dd($request->all());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
