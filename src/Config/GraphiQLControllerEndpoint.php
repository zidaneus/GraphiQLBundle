<?php

namespace Overblog\GraphiQLBundle\Config;

interface GraphiQLControllerEndpoint
{
    /**
     * Return a uri by it's schema name.
     */
    public function getBySchema(string $name): string;

    /**
     * Return the default uri.
     */
    public function getDefault(): string;
}
