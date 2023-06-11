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

namespace Evrinoma\DtoBundle\DependencyInjection;

use Evrinoma\DtoBundle\EvrinomaDtoBundle;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder(EvrinomaDtoBundle::BUNDLE);
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('services')->addDefaultsIfNotSet()->children()
            ->scalarNode('identity')->defaultValue('class')->info('This option is used to identity overriding')->end()
            ->end()->end()
            ->end();

        return $treeBuilder;
    }
}
