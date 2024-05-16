<?php

namespace App\Http\Controllers\V1;

use App\DTO\V1\Patient\PatientStoreDTO;
use App\DTO\V1\Patient\PatientUpdateDTO;
use App\Exceptions\JsonNotFoundException;
use App\Http\Requests\PatientStoreRequest;
use App\Http\Requests\PatientUpdateRequest;
use App\Models\Patient;
use App\Services\V1\PatientService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class PatientController extends BaseController
{

    public function __construct(
        protected PatientService $patientService
    )
    {
        $this->patientService = $patientService;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function index()
    {
        try {
            return $this->patientService->index();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param Patient $patient
     * @return JsonResponse
     */
    public function show(Patient $patient)
    {
        $user = $this->patientService->find($patient);
        return response()->json($user, 200);
    }

    /**
     * @param PatientStoreRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(PatientStoreRequest $request)
    {
        try {
            $patientDto = new PatientStoreDTO(
                $request->input('name'),
                $request->input('email'),
                $request->input('address'),
                $request->input('phone_number'),
                $request->file('document_image')
            );
            $user = $this->patientService->store($patientDto);
            return response()->json($user, 201);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function update(PatientUpdateRequest $request, Patient $patient)
    {
        $patientDto = new PatientUpdateDTO(
            $patient->id,
            $request->input('name'),
            $request->input('address'),
            $request->input('phone_number'),
            $request->file('document_image')
        );
        $user = $this->patientService->update($patientDto, $patient);
        return response()->json($user, 200);
    }

    /**
     * @param Patient $patient
     * @return void
     * @throws Exception
     */
    public function destroy(Patient $patient)
    {
        try {
            $patient = $this->patientService->destroy($patient);
            return response()->json($patient, 204);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $token
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * @throws Exception
     */
    public function updateEmailValidation($token)
    {
        try {
            return $this->patientService->updateEmailValidation($token);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
