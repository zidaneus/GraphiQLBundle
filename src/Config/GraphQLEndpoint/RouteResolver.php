<?php

namespace Overblog\GraphiQLBundle\Config\GraphQLEndpoint;

use Overblog\GraphiQLBundle\Config\GraphiQLControllerEndpoint;
use Symfony\Component\Routing\RouterInterface;

final readonly class RouteResolver implements GraphiQLControllerEndpoint
{
    public function __construct(private RouterInterface $router, private array $routeCollection)
    {
    }

    public function getBySchema(string $name): string
    {
        $route = null;

        if (is_callable($this->routeCollection)) {
            $route = call_user_func($this->routeCollection, $name);
        }

        if (null === $route && array_key_exists($name, $this->routeCollection)) {
            $route = $this->routeCollection[$name];
        }

        if (!is_array($route)) {
            throw GraphQLEndpointInvalidSchemaException::forSchemaAndResolver($name, self::class);
        }

        return $this->router->generate(...$route);
    }

    public function getDefault(): string
    {
        return $this->getBySchema('default');
    }
}
