<?php

namespace Marqant\GraphQLSQLLog\Listeners;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

/**
 * Class GetSQLExecutionInformation
 *
 * @package App\Listeners
 */
class GetSQLExecutionInformation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        if (App::environment() !== 'production') {
            $Logs = DB::getQueryLog();

            array_push($event->result->extensions, [
                    "sqlInfo" => [
                        "executed_queries_count" => count($Logs),
                        "executed_queries"      => $Logs,
                    ],
                ]);
        }
    }
}
