<?php

namespace Tests\SmokeTesting;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Exception;

class CheckServicesContainerTest extends KernelTestCase
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

        $environment = $this->getContainer()->get('kernel')->getEnvironment();
        $classNameDebugContainer = sprintf('app%sDebugProjectContainer', ucwords($environment));
        $reflect = new \ReflectionClass($classNameDebugContainer);
        $reflectionPropertyMethodMap = $reflect->getProperty('methodMap');
        $reflectionPropertyMethodMap->setAccessible(true);
        $services = array_keys($reflectionPropertyMethodMap->getValue($this->getContainer()));

        foreach ($services as $key => $serviceName) {
            if (0 !== strpos($serviceName, 'prefixService')) {
                continue;
            }
            try {
                $this->getContainer()->get($serviceName);
            } catch (ServiceNotFoundException $exception) {
                $this->fail(sprintf('Service Not Found: %s', $exception->getMessage()));
            } catch (ServiceCircularReferenceException $exception) {
                $this->fail(sprintf('Service Circular Reference: %s', $exception->getMessage()));
            } catch (Exception $exception) {
                $this->fail(sprintf('Service Error: %s', $exception->getMessage()));
            }
        }

        $this->assertTrue(true);
    }
}
