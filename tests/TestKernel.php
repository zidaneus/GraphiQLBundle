<?php

namespace Overblog\GraphiQLBundle\Tests;

use Symfony\Component\HttpKernel\Kernel;

abstract class TestKernel extends Kernel
{
    private mixed $testCase;

    public function __construct($environment, $debug, $testCase = null)
    {
        $this->testCase = $testCase ?? false;
        parent::__construct($environment, $debug);
    }

    public function getCacheDir(): string
    {
        return sys_get_temp_dir().'/OverblogGraphQLBundle/'.Kernel::VERSION.'/'.$this->testCase.'/cache/'.$this->environment;
    }

    public function getLogDir(): string
    {
        return sys_get_temp_dir().'/OverblogGraphQLBundle/'.Kernel::VERSION.'/'.$this->testCase.'/logs';
    }

    public function isBooted(): bool
    {
        return $this->booted;
    }
}
