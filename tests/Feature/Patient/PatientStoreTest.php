<?php

use Illuminate\Http\UploadedFile;

uses()->group('patient');


it('Empty parameters', function () {
    $response = $this->postJson(route('patients.store', []));
    $response->assertUnprocessable();
});

it('The input parameters are entered, but one or more of the following are missing: address, phone_number, document_image.', function () {
    $response = $this->postJson(route('patients.store', ['name' => 'tomas sueldo', 'email' => 'tomas@mail.com']));
    $response->assertUnprocessable();
});

it('The input parameters are entered and filled correctly, but the file type is not valid.', function () {
    $file = ['document_image' => UploadedFile::fake()->create('file1.exe', 6000)];

    $response = $this->postJson(route('patients.store', ['name' => 'tomas sueldo', 'email' => 'tomas@mail.com', 'address' => 'av. liberty 2323', 'phone_number' => '5491123232323']), $file);
    $response->assertUnprocessable();
});

it('The input parameters are entered and filled correctly, and the file has a valid extension.', function () {
    $file = ['document_image' => UploadedFile::fake()->image('file1.png')->size(1)];

    $patient = \App\Models\Patient::factory()->make();

    $response = $this->postJson(route('patients.store', [
        'name' => $patient->name,
        'email' => $patient->email,
        'address' => $patient->address,
        'phone_number' => $patient->phone_number,
    ]), $file);

    $response->assertCreated();
    $patient->forceDelete();
});



