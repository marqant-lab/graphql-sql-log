<?php

namespace Marqant\GraphQLSQLLog\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

/**
 * Class SQLLogServiceProvider
 *
 * @package Marqant\GraphQLSQLLog\Providers
 */
class GraphQLSQLLogServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        if ($this->app->environment() !== 'production') {
            // The environment is local
            DB::enableQueryLog();
        }

        $this->app->register(GraphQLSQLLogEventServiceProvider::class);
    }
}
