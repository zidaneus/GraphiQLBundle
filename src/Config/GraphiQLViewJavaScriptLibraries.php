<?php

namespace Overblog\GraphiQLBundle\Config;

final readonly class GraphiQLViewJavaScriptLibraries
{
    public function __construct(
        private string $graphiQLVersion,
        private string $reactVersion,
        private string $fetchVersion
    ) {
    }

    public function getGraphiQLVersion(): string
    {
        return $this->graphiQLVersion;
    }

    public function getReactVersion(): string
    {
        return $this->reactVersion;
    }

    public function getFetchVersion(): string
    {
        return $this->fetchVersion;
    }
}
