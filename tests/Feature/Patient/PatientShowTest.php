<?php
uses()->group('patient');

it('Patient not found', function () {
    $response = $this->getJson(route('patients.show', ['patient' => 'asdsd']));
    $response->assertNotFound();
});


it('Valid patient id', function () {
    $patient = \Database\Factories\PatientFactory::new()->create();

    $response = $this->getJson(route('patients.show', ['patient' => $patient->id]));
    $response->assertOk();

    $patient->forceDelete();
});
