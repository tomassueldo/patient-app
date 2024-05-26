<?php
uses()->group('patient');

it('Empty parameters', function () {
    $response = $this->getJson(route('patients.index', []));
    $response->assertOk();
});
