<?php

namespace Tests\SmokeTesting;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Exception;

class CheckServicesContainerSmokeTestingTest extends KernelTestCase
{
    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
    }

    /**
     * @return \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected function getContainer()
    {
        return static::$kernel->getContainer();
    }

    /**
     * We are checking all custom services (Service Name: "prefixService_.....")
     * in the container can be gotten in right way.
     *
     * @test
     * @group smoke_testing
     */
    public function check()
    {
        $reflect = new \ReflectionClass('appTestDebugProjectContainer');
        $reflectionPropertyMethodMap = $reflect->getProperty('methodMap');
        $reflectionPropertyMethodMap->setAccessible(true);
        $services = array_keys($reflectionPropertyMethodMap->getValue($this->getContainer()));

        foreach ($services as $key => $serviceName) {
            if (0 !== strpos($serviceName, 'prefixService')) {
                continue;
            }
            try {
                $this->getContainer()->get($serviceName);
                $this->assertTrue(true);
            } catch (ServiceNotFoundException $exception) {
                $this->fail(sprintf('Service Not Found: %s', $exception->getMessage()));
            } catch (ServiceCircularReferenceException $exception) {
                $this->fail(sprintf('Service Circular Reference: %s', $exception->getMessage()));
            } catch (Exception $exception) {
                $this->fail(sprintf('Service Error: %s', $exception->getMessage()));
            }
        }
    }
}
