<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\PatientStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PatientController extends BaseController
{

    public function __construct()
    {
    }

    public function store(Request $request)
    {
        try {
            dd(app()->env);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
