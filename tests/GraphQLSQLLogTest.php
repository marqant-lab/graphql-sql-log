<?php

namespace Marqant\GraphQLSQLLog\Tests;

use Tests\TestCase;
use \Nuwave\Lighthouse\Testing\UsesTestSchema;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;

/**
 * Class GraphQLSQLLogTest
 *
 * @package Marqant\GraphQLSQLLog\Tests
 */
class GraphQLSQLLogTest extends TestCase
{
    use UsesTestSchema;
    use MakesGraphQLRequests;

    /**
     * @group GraphQLSQLLog
     *
     * @test
     */
    public function testHaveSqlLog(): void
    {
        $model = config('auth.providers.users.model');
        $this->schema = /** @lang GraphQL */ '
            type User {
                email: String!
            }
            
            type Query {
                users: [User] @paginate(model: "' . addslashes($model) . '")
            }
        ';

        $this->setUpTestSchema();

        // create a User
        factory($model)->create();

        // get users
        $usersResponse = $this->postGraphQL([
            "query" => 'query Users($first: Int!, $page: Int) {
                users(first: $first, page: $page) {
                    data {
                        email
                    }
                }
            }',
            "variables" => [
                'first' => 10,
                'page'  => 1,
            ],
        ]);

        $usersResponse->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'users' => [
                        'data' => [
                            '*' => [
                                'email'
                            ]
                        ]
                    ]
                ],
                'extensions' => [
                    '*' => [
                        'sqlInfo' => [
                            'executed_queries_count',
                            'executed_queries',
                        ]
                    ]
                ]
            ]);
    }
}
