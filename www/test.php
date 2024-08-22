<?php
declare(strict_types=1);

use Illuminate\Support\Facades\DB;

require_once( __DIR__ . '/vendor/autoload.php');
$app = require_once  __DIR__ . '/bootstrap/app.php';

$kernel= $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

DB::transaction(
    function () {
        $job = \App\Jobs\ProcessEvent::dispatch();
    }
);
