<?php


namespace Evrinoma\DtoBundle\DependencyInjection;

use Evrinoma\DtoBundle\EvrinomaDtoBundle;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class EvrinomaDtoBundleExtension extends Extension
{

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }


    public function getAlias()
    {
        return EvrinomaDtoBundle::DTO_BUNDLE;
    }

}