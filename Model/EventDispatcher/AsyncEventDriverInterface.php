<?php

namespace BDK\AsyncDispatcherBundle\Model\EventDispatcher;

use BDK\AsyncDispatcherBundle\Model\EventDispatcher\AsyncEventInterface;

/**
 * AsyncEventDriverInterface
 *
 * @copyright Bodaclick S.A
 * @author Eduardo Gulias Davis <eduardo.gulias@bodaclick.com>
 */
interface AsyncEventDriverInterface
{
    /**
     * getName
     *
     * @return string
     */
    public function getName();

    /**
     * publish
     *
     * @param AsyncEventInterface $event
     *
     * @return AsyncEventInterface
     */
    public function publish(AsyncEventInterface $event);
}
