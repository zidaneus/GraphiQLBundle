<?php

namespace Overblog\GraphiQLBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

// see https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Tests/Functional/ForwardCompatTestCaseTrait.php

if (70000 <= \PHP_VERSION_ID && (new \ReflectionMethod(WebTestCase::class, 'tearDown'))->hasReturnType()) {
    eval('
        namespace Overblog\GraphiQLBundle\Tests;

        /**
         * @internal
         */
        trait ForwardCompatTestCaseTrait
        {
            protected function tearDown(): void
            {
                static::ensureKernelShutdown();
                static::$kernel = null;
            }
        }
    ');
} else {
    /**
     * @internal
     */
    trait ForwardCompatTestCaseTrait
    {
        protected function tearDown(): void
        {
            static::ensureKernelShutdown();
            static::$kernel = null;
        }
    }
}
