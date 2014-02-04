<?php

namespace BDK\AsyncDispatcherBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see
 * {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 *
 * @author    Eduardo Gulias <eduardo.gulias@bodaclick.com>
 * @author    Moises Gallego <moises.gallego@bodaclick.com>
 * @copyright 2012 Bodaclick S.A.
 */
class Configuration implements ConfigurationInterface
{

    /**
     * getConfigTreeBuilder
     *
     * {@inheritDoc}
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root('bdk_async_dispatcher');

        return $treeBuilder;
    }
}
