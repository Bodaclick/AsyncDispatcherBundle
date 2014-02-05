<?php

/*
 * This file is part of the BDKAsyncDispatcherBundle package.
 *
 * (c) Bodaclick S.L. <http://bodaclick.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BDK\AsyncDispatcherBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use BDK\AsyncDispatcherBundle\DependencyInjection\Compiler\AsyncEventDispatcherPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class BDKAsyncDispatcherBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AsyncEventDispatcherPass());
    }
}
