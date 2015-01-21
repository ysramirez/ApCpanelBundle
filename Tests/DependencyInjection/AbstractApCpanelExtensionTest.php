<?php
//http://egeloen.fr/2013/12/08/unit-test-your-symfony2-bundle-di-like-a-boss/
namespace Ap\CpanelBundle\Tests\DependencyInjection;

use Ap\CpanelBundle\DependencyInjection\ApCpanelExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

abstract class AbstractApCpanelExtensionTest extends \PHPUnit_Framework_TestCase
{
    private $apCpanelExtension;
    private $container;

    protected function setUp()
    {
        $this->apCpanelExtension = new ApCpanelExtension();

        $this->container = new ContainerBuilder();
        $this->container->registerExtension($this->apCpanelExtension);
    }

    abstract protected function loadConfiguration(ContainerBuilder $container, $resource);

    public function testDomainConfiguration()
    {
        $this->loadConfiguration($this->container, 'configuration');
        $this->container->compile();

        $this->assertTrue($this->container->has('ap_cpanel.api'));
    }
}