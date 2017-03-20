<?php

namespace Tests\Functional;

use Tests\AppKernel;
use BernardoSecades\FunctionalTestBundle\Lib\MyService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MyTest extends KernelTestCase
{
    /** @var  ContainerInterface */
    protected $container;

    protected function setUp()
    {
        parent::setUp();

        $kernel = new AppKernel('test', true);
        $kernel->boot();
        $this->container = $kernel->getContainer();
    }

    /**
     * @test
     */
    public function checkMyService()
    {
        $myService = $this->container->get('bernardosecades.my_service');

        $this->assertInstanceOf(MyService::class, $myService);
        $this->assertTrue($myService->myAction());
    }
}
