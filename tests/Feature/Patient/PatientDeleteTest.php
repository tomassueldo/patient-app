<?php

uses()->group('patient');


it('Patient not found', function () {
    $response = $this->deleteJson(route('patients.destroy', ['patient' => 'asdsd']));
    $response->assertNotFound();
});

it('Valid patient id', function () {
    $patient = \Database\Factories\PatientFactory::new()->create();

    $response = $this->deleteJson(route('patients.destroy', [
        'patient' => $patient->id
    ]));
    $response->assertNoContent();

    $patient->forceDelete();
});



