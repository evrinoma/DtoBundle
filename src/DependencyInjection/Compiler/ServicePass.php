<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\DtoBundle\DependencyInjection\Compiler;

use Evrinoma\DtoBundle\EvrinomaDtoBundle;
use Symfony\Component\DependencyInjection\Compiler\AbstractRecursivePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ServicePass extends AbstractRecursivePass
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $serviceIdentity = $container->hasParameter('evrinoma.'.EvrinomaDtoBundle::BUNDLE.'.identity');
        if ($serviceIdentity) {
            $serviceIdentity = $container->getParameter('evrinoma.'.EvrinomaDtoBundle::BUNDLE.'.identity');
            $identityAlias = $container->getAlias($serviceIdentity);
            $identityDefinition = $container->getDefinition($identityAlias->__toString());
            $identityDefinition->addTag('evrinoma.'.EvrinomaDtoBundle::BUNDLE.'.service');
        }
    }
}
