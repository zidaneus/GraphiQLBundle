<?php

namespace Overblog\GraphiQLBundle\Tests\Functional\DependencyInjection\Yaml;

use Overblog\GraphiQLBundle\Tests\Functional\DependencyInjection\Fixtures\Yaml\TestKernel;
use Overblog\GraphiQLBundle\Tests\TestCase;

final class ConfigurationTest extends TestCase
{
    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }

    public function setUp(): void
    {
        self::bootKernel(['test_case' => str_replace('\\', '_', __NAMESPACE__)]);
    }

    public function testSuccessConfiguration(): void
    {
        /** @var TestKernel $kernel */
        $kernel = self::$kernel;

        $this->assertTrue($kernel->isBooted());
    }
}
