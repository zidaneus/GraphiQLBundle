<?php

namespace Overblog\GraphiQLBundle\Controller;

use Overblog\GraphiQLBundle\Config\GraphiQLControllerEndpoint;
use Overblog\GraphiQLBundle\Config\GraphiQLViewConfig;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment as TwigEnvironment;

final readonly class GraphiQLController
{
    public function __construct(
        private TwigEnvironment $twig,
        private GraphiQLViewConfig $viewConfig,
        private GraphiQLControllerEndpoint $graphQLEndpoint
    ) {
    }

    public function indexAction($schemaName = null): Response
    {
        $endpoint = null === $schemaName ? $this->graphQLEndpoint->getDefault() : $this->graphQLEndpoint->getBySchema($schemaName);

        return new Response($this->twig->render(
            $this->viewConfig->getTemplate(),
            [
                'endpoint' => $endpoint,
                'versions' => [
                    'graphiql' => $this->viewConfig->getJavaScriptLibraries()->getGraphiQLVersion(),
                    'react' => $this->viewConfig->getJavaScriptLibraries()->getReactVersion(),
                    'fetch' => $this->viewConfig->getJavaScriptLibraries()->getFetchVersion(),
                ],
            ]
        ));
    }
}
