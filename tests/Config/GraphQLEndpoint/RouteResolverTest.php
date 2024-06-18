<?php

namespace Overblog\GraphiQLBundle\Tests\Config\GraphQLEndpoint;

use Overblog\GraphiQLBundle\Config\GraphQLEndpoint\GraphQLEndpointInvalidSchemaException;
use Overblog\GraphiQLBundle\Config\GraphQLEndpoint\RouteResolver;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\RouterInterface;
use function Webmozart\Assert\Tests\StaticAnalysis\string;

final class RouteResolverTest extends TestCase
{
    protected RouterInterface&MockObject $router;

    public function setUp(): void
    {
        $this->router = $this->createMock(RouterInterface::class);
    }

    private function subject(array $routeCollection): RouteResolver
    {
        return new RouteResolver(
            $this->router,
            $routeCollection
        );
    }

    public function testInvalidRoute(): void
    {
        $routeResolver = $this->subject([]);

        $this->expectException(GraphQLEndpointInvalidSchemaException::class);
        $this->expectExceptionMessage('Schema "default" isn\'t valid for resolver "Overblog\GraphiQLBundle\Config\GraphQLEndpoint\RouteResolver"');

        $routeResolver->getDefault();
    }

    public function testArrayRoutes(): void
    {
        $matcher = $this->exactly(3);
        $this->router->expects($matcher)
            ->method('generate')
            ->willReturnCallback(function (string $key, string $value) use ($matcher) {
                return match ($matcher->numberOfInvocations()) {
                    0, 1 => ['route_schema_default'],
                    2 => ['route_schema_star_wars']
                };
            })
            ->willReturnOnConsecutiveCalls('/', '/', '/star-wars');

        $routeCollection = [
            'default' => ['route_schema_default'],
            'starWars' => ['route_schema_star_wars'],
        ];

        $routeResolver = $this->subject($routeCollection);

        $this->assertEquals('/', $routeResolver->getDefault());
        $this->assertEquals('/', $routeResolver->getBySchema('default'));
        $this->assertEquals('/star-wars', $routeResolver->getBySchema('starWars'));
    }
}
