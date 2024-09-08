<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Cache;

require_once( __DIR__ . '/vendor/autoload.php');
$app = require_once  __DIR__ . '/bootstrap/app.php';

$kernel= $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

//Cache::put('key', 'value');
//$lock = Cache::lock('baz');
//$lock->get();
\App\Jobs\ProcessEvent::dispatch(1);
\App\Jobs\ProcessEvent::dispatch(2);
