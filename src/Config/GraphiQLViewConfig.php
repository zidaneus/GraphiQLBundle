<?php

namespace Overblog\GraphiQLBundle\Config;

final readonly class GraphiQLViewConfig
{
    public function __construct(private GraphiQLViewJavaScriptLibraries $javaScriptLibraries, private string $template)
    {
    }

    public function getJavaScriptLibraries(): GraphiQLViewJavaScriptLibraries
    {
        return $this->javaScriptLibraries;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }
}
