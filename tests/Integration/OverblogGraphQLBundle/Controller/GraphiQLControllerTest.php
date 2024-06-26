<?php

namespace Overblog\GraphQLBundle\Tests\Integration\OverblogGraphQLBundle\Controller;

use Overblog\GraphiQLBundle\Tests\Integration\OverblogGraphQLBundle\TestCase;
use Symfony\Component\HttpFoundation\Response;

final class GraphiQLControllerTest extends TestCase
{
    public function testDefaultSchema(): void
    {
        $client = self::createClient();

        $client->request('GET', '/graphiql');
        $response = $client->getResponse();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->stringContains('Loading...', $response->getContent());
        $this->stringContains('var endpoint = "\/"', $response->getContent());
    }
}
