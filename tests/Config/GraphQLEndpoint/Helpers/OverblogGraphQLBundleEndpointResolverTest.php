<?php

namespace Overblog\GraphiQLBundle\Tests\Config\GraphQLEndpoint\Helpers;

use Overblog\GraphiQLBundle\Config\GraphQLEndpoint\Helpers\OverblogGraphQLBundleEndpointResolver;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class OverblogGraphQLBundleEndpointResolverTest extends TestCase
{
    public function testGetDefaultRoute(): void
    {
        $defaultRoute = OverblogGraphQLBundleEndpointResolver::getByName('default');
        $this->assertSame(['overblog_graphql_endpoint'], $defaultRoute);
    }

    #[DataProvider(methodName: 'getSchemas')]
    public function testGetWithSchemaName($schemaName, $expectedResult): void
    {
        $route = OverblogGraphQLBundleEndpointResolver::getByName($schemaName);
        $this->assertSame($expectedResult, $route);
    }

    public static function getSchemas(): array
    {
        return [
            ['bla', [
                'overblog_graphql_multiple_endpoint',
                ['schemaName' => 'bla'],
            ]],
            ['star-wars', [
                'overblog_graphql_multiple_endpoint',
                ['schemaName' => 'star-wars'],
            ]],
        ];
    }
}
