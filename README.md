# Lighthouse GraphQL SQL Log(s).


## What is it?

This package contains SQL logging for GraphQL queries and mutations.  
You will get all executed queries at response.  


## Installation

Require the package through composer.

```shell script
$ composer require marqant-lab/graphql-sql-log
```


### Example

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

## Tests

To run tests, you first need to set up a sqlite database that we use to get snapshots of the database state. Run the
 following command from within your project root to create the sqlite database.
 
```shell script
$ touch database/database.sqlite
```

If you want to execute package tests add this to the phpunit.xml
                                     
```xml
        <testsuite name="GraphQLSQLLog">
            <directory suffix="Test.php">./vendor/marqant-lab/graphql-sql-log/tests</directory>
        </testsuite>
```

And after you can check it by executing:
```shell script
$ php artisan test --group=GraphQLSQLLog
or
$ phpunit --group=GraphQLSQLLog
```
