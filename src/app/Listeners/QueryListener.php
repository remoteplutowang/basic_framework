<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log;

class QueryListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $params = $event->bindings;
        foreach ($event->bindings as $index => $param) {
            if ($param instanceof \DateTime) {
                $params[$index] = $param->format('Y-m-d H:i:s');
            }
        }
        $sql = str_replace("?", "'%s'", $event->sql);
        array_unshift($params, $sql);
        Log::channel("sql")->info(call_user_func_array('sprintf', $params));
    }
}
