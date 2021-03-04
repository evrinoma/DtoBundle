<?php


namespace Evrinoma\DtoBundle;

use Evrinoma\DtoBundle\DependencyInjection\EvrinomaDtoBundleExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaDtoBundle extends Bundle
{
    public const DTO_BUNDLE = 'dto';

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaDtoBundleExtension();
        }
        return $this->extension;
    }
}