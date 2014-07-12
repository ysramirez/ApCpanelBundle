<?php 
namespace Ap\CpanelBundle\Tests\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

use Ap\CpanelBundle\Tests\DependencyInjection\AbstractApCpanelExtensionTest;

class YamlApCpanelExtensionTest extends AbstractApCpanelExtensionTest
{
    protected function loadConfiguration(ContainerBuilder $container, $resource)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/Fixtures/Yaml/'));
        $loader->load($resource.'.yml');
    }
}