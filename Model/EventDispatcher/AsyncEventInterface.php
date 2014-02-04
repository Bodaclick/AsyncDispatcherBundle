<?php

namespace BDK\AsyncDispatcherBundle\Model\EventDispatcher;

/**
 * AsyncEventInterface
 *
 * @copyright Bodaclick S.A
 * @author Eduardo Gulias Davis <eduardo.gulias@bodaclick.com>
 */
interface AsyncEventInterface
{
    /**
     * getName
     *
     * @return string
     */
    public function getName();
}
