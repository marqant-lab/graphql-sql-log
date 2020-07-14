# Lighthouse GraphQL SQL Log(s).

## What is it?

This package contains SQL logging for GraphQL queries and mutations.  
You will get all executed queries at response.  


## Installation

Require the package through composer.

```shell script
$ compsoer require marqant-lab/sql-log
```

After this please add to your project’s AppServiceProvider next:

```php
...
use Illuminate\Support\Facades\DB;
...
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        ...
        if ($this->app->environment() !== 'production') {
            // The environment is local
            DB::enableQueryLog();
        }
    }
```

Add to your project’s EventServiceProvider next listener:

```php
...
use Nuwave\Lighthouse\Events\ManipulateResult;
use Marqant\SQLLog\Listeners\GetSQLExecutionInformation;
...
/**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ...
        ManipulateResult::class => [
            GetSQLExecutionInformation::class
        ],
    ];
```

###Example

Example of response data:

```json
{
    "data": {
        ...
    },
    "extensions": [
        {
            "sqlInfo": {
                "executed_queries_count": 7,
                "executed_queries": [
                    ...
                    {
                        "query": "select * from `users` where `users`.`id` = ? limit 1",
                        "bindings": [
                            2
                        ],
                        "time": 3.48
                    }
                    ...
                ]
            }
        }
    ]
}
```
