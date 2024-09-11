<?php


use Illuminate\Support\Facades\DB;

beforeAll(function () {

});

it('Job test', function () {

    $app = require  __DIR__ . '/../../bootstrap/app.php';

    $kernel= $app->make(\Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    $job = \App\Jobs\ProcessEventWithErrors::dispatch();

});
