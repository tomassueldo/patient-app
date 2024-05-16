<?php

namespace App\Repositories\V1;

use App\Exceptions\JsonNotFoundException;
use App\Exceptions\PatientNotFoundException;
use App\Models\Patient;
use App\Repositories\V1\PatientRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class PatientRepository implements PatientRepositoryInterface
{

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Exception
     */
    public function index()
    {
        try {
            return Patient::all();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return mixed
     * @throws PatientNotFoundException
     */
    public function find($id)
    {
        try {
            return Patient::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new PatientNotFoundException();
        }
    }


    /**
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function store(array $data)
    {
        try {
            return Patient::create($data);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param array $data
     * @param Patient $patient
     * @return Patient
     * @throws \Exception
     */
    public function update(array $data, Patient $patient)
    {
        try {
            $patient->name = $data['name'];
            $patient->address = $data['address'];
            $patient->phone_number = $data['phone_number'];
            $patient->document_image = $data['document_image'];
            $patient->save();
            return $patient;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param Patient $patient
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Patient $patient)
    {
        try {
            return $patient->delete();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param $token
     * @return mixed
     * @throws \Exception
     */
    public function getPatientWithToken($token)
    {
        try {
            return Patient::where('email_verification_token', $token)->first();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
