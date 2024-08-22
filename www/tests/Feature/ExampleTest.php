<?php

use Illuminate\Support\Facades\DB;

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
