<?php


use Illuminate\Support\Facades\App;

it('Job test', function () {

    $job = (new \App\Jobs\ProcessEvent())->onQueue('events');

    dispatch($job);

});
