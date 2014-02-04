<?php

namespace BDK\AsyncDispatcherBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use \Exception;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 *
 * @author    Eduardo Gulias <eduardo.gulias@bodaclick.com>
 * @copyright 2012 Bodaclick S.A.
 */
class BDKAsyncDispatcherExtension extends Extension
{

    /**
     * {@inheritDoc}
     *
     * @param array            $configs   configuraciones
     * @param ContainerBuilder $container contenedor
     *
     * @return none
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $loader->load('services.yml');
    }
}
