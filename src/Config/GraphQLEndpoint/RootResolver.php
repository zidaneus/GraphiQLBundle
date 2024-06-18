<?php

namespace Overblog\GraphiQLBundle\Config\GraphQLEndpoint;

use Overblog\GraphiQLBundle\Config\GraphiQLControllerEndpoint;

final class RootResolver implements GraphiQLControllerEndpoint
{
    public function getBySchema(string $name): string
    {
        if ('default' === $name) {
            return '/';
        }

        throw GraphQLEndpointInvalidSchemaException::forSchemaAndResolver($name, self::class);
    }

    public function getDefault(): string
    {
        return $this->getBySchema('default');
    }
}
