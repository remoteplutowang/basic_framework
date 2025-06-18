<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log;

class LogQueryExecuted
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
        $query = $event->sql;
        $bindings = $event->bindings;
        $time = $event->time;
        // Log the query and its execution time
        Log::info('Query Executed', [
            'query' => $query,
            'bindings' => $bindings,
            'time' => $time,
        ]);
    }
}
