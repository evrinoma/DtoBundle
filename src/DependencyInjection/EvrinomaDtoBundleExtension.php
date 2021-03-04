<?php


namespace Evrinoma\DtoBundle\DependencyInjection;

use Evrinoma\DtoBundle\EvrinomaDtoBundle;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class EvrinomaDtoBundleExtension
 *
 * @package Evrinoma\DtoBundle\DependencyInjection
 */
class EvrinomaDtoBundleExtension extends Extension
{
//region SECTION: Public
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
//endregion Public

//region SECTION: Getters/Setters
    public function getAlias()
    {
        return EvrinomaDtoBundle::DTO_BUNDLE;
    }
//endregion Getters/Setters
}