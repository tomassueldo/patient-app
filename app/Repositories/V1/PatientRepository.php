<?php

namespace App\Repositories\V1;

use App\Exceptions\JsonNotFoundException;
use App\Exceptions\PatientNotFoundException;
use App\Models\Patient;
use App\Repositories\V1\PatientRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class PatientRepository implements PatientRepositoryInterface
{

    /**
     * Retrieves all the patients stored
     * @return Collection
     * @throws Exception
     */
    public function index(): Collection
    {
        try {
            return Cache::remember('users', 10, function () {
                return Patient::all();
            });
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    /**
     * Retrieves the information of the patient with the id passed by path parameter
     * @param $id
     * @return Patient
     * @throws PatientNotFoundException
     */
    public function find($id): Patient
    {
        try {
            return Patient::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new PatientNotFoundException();
        }
    }


    /**
     * Store a new record of patient
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function store(array $data)
    {
        try {
            return Patient::create($data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Updates the patient record using the id passed by path parameter
     * @param array $data
     * @param Patient $patient
     * @return Patient
     * @throws Exception
     */
    public function update(array $data, Patient $patient)
    {
        try {
            $patient->update($data);
            return $patient;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Delete from the database the patient passed by path parameter
     * @param Patient $patient
     * @return bool
     * @throws Exception
     */
    public function destroy(Patient $patient): bool
    {
        try {
            return $patient->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Get the patient with the token given by parameter
     * @param $token
     * @return mixed
     * @throws Exception
     */
    public function getPatientWithToken($token)
    {
        try {
            return Patient::where('email_verification_token', $token)->first();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
