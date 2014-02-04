<?php

namespace BDK\AsyncDispatcherBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * AsyncEventDispatcherPass
 *
 * @author    Eduardo Gulias Davis <eduardo.gulias@bodaclick.com>
 * @copyright 2013 Bodaclick S.A
 */
class AsyncEventDispatcherPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('bdk.async_event_dispatcher');
        $taggedDrivers = $container->findTaggedServiceIds('bdk.async_event_dispatcher');
        foreach ($taggedDrivers as $serviceId => $attributes) {
            $driverReference = $container->getDefinition($serviceId);
            $this->generateCalls($attributes, $driverReference, $definition);
        }
    }

    /**
     * generateCalls
     *
     * @param array      $attributes
     * @param Reference  $driverReference
     * @param Definition $definition
     */
    protected function generateCalls($attributes, $driverReference, $definition)
    {
        foreach ($attributes as $attribute) {
            $eventName = (isset($attribute['event'])) ? $attribute['event'] : null;
            $definition->addMethodCall('addDriver', array($driverReference, $eventName));
            if (!$eventName) {
                break;
            }
        }
    }
}
