<?php

namespace Marqant\GraphQLSQLLog\Providers;

use Nuwave\Lighthouse\Events\ManipulateResult;
use Marqant\GraphQLSQLLog\Listeners\GetSQLExecutionInformation;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class GraphQLSQLLogEventServiceProvider
 *
 * @package Marqant\GraphQLSQLLog\Providers
 */
class GraphQLSQLLogEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ManipulateResult::class => [
            GetSQLExecutionInformation::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
