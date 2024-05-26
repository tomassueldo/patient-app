<?php

use Illuminate\Http\UploadedFile;

uses()->group('patient');


it('Patient not found', function () {
    $response = $this->putJson(route('patients.update', ['patient' => 'asdsd']));
    $response->assertNotFound();
});

it('The input parameters are entered, but the pone number has an invalid length.', function () {
    $patient = \Database\Factories\PatientFactory::new()->create();

    $response = $this->putJson(route('patients.update', ['patient' => $patient->id, 'name' => 'tomas sueldo', 'phone_number' => '5491123232321231231231233']));

    $response->assertUnprocessable();
    $patient->forceDelete();
});

it('The input parameters are entered and filled correctly, but the file type is not valid.', function () {
    $patient = \Database\Factories\PatientFactory::new()->create();

    $file = ['document_image' => UploadedFile::fake()->create('file1.exe', 6000)];

    $response = $this->putJson(route('patients.update', ['patient' => $patient->id, 'name' => 'tomas sueldo', 'address' => 'av. liberty 2323']), $file);
    $response->assertUnprocessable();
    $patient->forceDelete();
});

it('The input parameters are entered and filled correctly, and the file has a valid extension.', function () {
    $patient = \Database\Factories\PatientFactory::new()->create();

    $response = $this->putJson(route('patients.update', [
        'patient' => $patient->id,
        'address' => $patient->address,
        'phone_number' => $patient->phone_number
    ]));

    $response->assertOk();
    $patient->forceDelete();
});



