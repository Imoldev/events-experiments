<?php
declare(strict_types=1);

use App\Models\User;

require_once( __DIR__ . '/vendor/autoload.php');
$app = require_once  __DIR__ . '/bootstrap/app.php';

$kernel= $app->make(\Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

$user = User::create(['name' => 'test', 'email' => 'test@test.com', 'password' => 'test' ]);
$user->createToken('test');
