<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Cache;

require_once( __DIR__ . '/vendor/autoload.php');
$app = require_once  __DIR__ . '/bootstrap/app.php';

$kernel= $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

for ($i=1; $i<=10; $i++){
    \App\Jobs\ProcessEventWithErrors::dispatch($i);
    \App\Jobs\ProcessEvent::dispatch($i);
}
