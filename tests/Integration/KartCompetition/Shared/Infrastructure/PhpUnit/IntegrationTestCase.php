<?php

declare(strict_types=1);

namespace DevAway\Tests\Integration\KartCompetition\Shared\Infrastructure\PhpUnit;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class IntegrationTestCase extends KernelTestCase
{
    /**
     * @return void
     */
    protected function setUp(): void
    {
        self::bootKernel(['environment' => 'test']);
        parent::setUp();
    }

    /**
     * @param string $className
     * @return object
     */
    protected function service($className)
    {
        return self::$container->get($className);
    }
}
