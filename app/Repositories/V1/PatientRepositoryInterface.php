<?php

namespace App\Repositories\V1;

use App\Models\Patient;

interface PatientRepositoryInterface
{
    public function index();

    public function find($id);

    public function store(array $data);

    public function update(array $data, Patient $patient);

    public function destroy(Patient $patient);

    public function getPatientWithToken($token);
}
