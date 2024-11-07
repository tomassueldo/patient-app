<?php

namespace App\Http\Controllers\V1;

use App\DTO\V1\Patient\PatientStoreDTO;
use App\DTO\V1\Patient\PatientUpdateDTO;
use App\Http\Requests\PatientStoreRequest;
use App\Http\Requests\PatientUpdateRequest;
use App\Models\Patient;
use App\Services\V1\PatientService;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
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
     * Retrieves all the patients stored
     * @return Collection
     * @throws Exception
     */
    public function index(): Collection
    {
        try {
            return $this->patientService->index();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Retrieves the information of the patient with the id passed by path parameter
     * @param Patient $patient
     * @return JsonResponse
     */
    public function show(Patient $patient): JsonResponse
    {
        $user = $this->patientService->find($patient);
        return response()->json($user, 200);
    }

    /**
     * Store a new record of patient
     * @param PatientStoreRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(PatientStoreRequest $request): JsonResponse
    {
        try {
            $patientDto = new PatientStoreDTO($request->all());
            $user = $this->patientService->store($patientDto);
            return response()->json($user, 201);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    /**
     * Updates the patient record using the id passed by path parameter
     * @param PatientUpdateRequest $request
     * @param Patient $patient
     * @return JsonResponse
     * @throws Exception
     */
    public function update(PatientUpdateRequest $request, Patient $patient): JsonResponse
    {
        $patientDto = new PatientUpdateDTO(
            $patient->id,
            $request->all()
        );
        $user = $this->patientService->update($patientDto, $patient);
        return response()->json($user, 200);
    }

    /**
     * Delete from the database the patient passed by path parameter
     * @param Patient $patient
     * @return Response
     * @throws Exception
     */
    public function destroy(Patient $patient): Response
    {
        try {
            $patient = $this->patientService->destroy($patient);
            return response()->noContent();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *Function that handles the validation of the email with the token stored in the register.
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

    /**
     * Retrieves all the patients and their appointments without cache
     * @return Collection
     * @throws Exception
     */
    public function appointmentsWithOutCache(): Collection
    {
        try {
            return $this->patientService->appointmentsWithOutCache();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Retrieves all the patients and their appointments with cache
     * @return Collection
     * @throws Exception
     */
    public function appointmentsWithCache(): string
    {
        try {
            return $this->patientService->appointmentsWithCache();


        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
