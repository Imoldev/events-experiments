<?php

use Illuminate\Support\Facades\DB;

it('returns a successful response', function () {
    $response = $this->post('api/tokens/create', [
        'email' => 'test@test.com',
        'password' => 'test'
    ]);

    $response->assertStatus(200);
    $response->assertExactJsonStructure(['test' => 1123]);
});
