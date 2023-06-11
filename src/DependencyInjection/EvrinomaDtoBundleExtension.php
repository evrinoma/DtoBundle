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
use Evrinoma\DtoBundle\Service\Identity\ClassIdentity;
use Evrinoma\DtoBundle\Service\Identity\Md5Identity;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class EvrinomaDtoBundleExtension extends Extension
{
    private static array $configuration = [
        'identity' => [
            'class' => ClassIdentity::class,
            'md5' => Md5Identity::class,
        ],
    ];

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);
        foreach ($config['services'] as $key => $service) {
            if (null !== $service) {
                switch ($key) {
                    case 'identity':
                        $serviceDefinition = (\array_key_exists($service, static::$configuration['identity']))
                            ? static::$configuration['identity'][$service]
                            : $service;
                        if (!class_exists($serviceDefinition)) {
                            $serviceDefinition = static::$configuration['identity']['class'];
                        }
                        $container->setParameter('evrinoma.'.$this->getAlias().'.identity', $serviceDefinition);

                        break;
                }
            }
        }
    }

    public function getAlias()
    {
        return EvrinomaDtoBundle::BUNDLE;
    }
}
